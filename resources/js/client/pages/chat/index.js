/**
 * External Dependencies
 */
 import React, { StrictMode, lazy, Suspense, useState, useEffect } from "react";
 import { render } from "react-dom";
 import Pusher from "pusher-js";
 /**
  * Internal Dependencies
  */
 import MessageDisplay from "./display";
 import "./style.scss";
 import ChatProvider from "./provider";
 import PageProvider from "./pageprovider";
 import MajorAction from "./majoraction";
 import {
     REACT_APP_PUSHER_APP_KEY,
     REACT_APP_PUSHER_APP_CLUSTER,
     FETCH_MESSAGES_ENDPOINT,
 } from "./constant";
 import JobProvider from "./jobprovider";
 import { JobContext } from "./context";
 const Header = lazy(() => import("./header"));
 const Action = lazy(() => import("./action"));
 
 var ChatInitator = $("#chat-initiator"); //default
 
 $("#chat-initiator").on("click", function () {
     ChatInitator = $("#chat-initiator");
 });
 
 $("#chat-initiator-final").on("click", function () {
     ChatInitator = $("#chat-initiator-final");
 });
 
 var getMessengerId = parseInt(ChatInitator.attr("data-chatreceiver")); //person to send message to
 console.log("[chat] Initiating chat with " + getMessengerId);
 if (
     document.querySelector("#vicomma-chat-module") != null &&
     ChatInitator == $("#chat-initiator")
 ) {
     document.querySelector("#vicomma-chat-module").style.display = "none";
 }
 
 if (
     document.querySelector("#vicomma-chat-module-final") != null &&
     ChatInitator == $("#chat-initiator-final")
 ) {
     document.querySelector("#vicomma-chat-module-final").style.display = "none";
 }
 Pusher.logToConsole = false;
 
 const pusher = new Pusher(REACT_APP_PUSHER_APP_KEY, {
     cluster: REACT_APP_PUSHER_APP_CLUSTER,
     encrypted: true,
     authEndpoint: authEndpoint,
     auth: {
         headers: {
             "X-CSRF-TOKEN": tkon,
         },
     },
 });
 
 const channel = pusher.subscribe("private-chatify");
 
 /**
  *-------------------------------------------------------------
  * Slide to bottom on [action] - e.g. [message received, sent, loaded]
  *-------------------------------------------------------------
  */
 function scrollBottom() {
     $(".messages-container").animate({
         scrollTop: $(".messages-container")[0].scrollHeight,
     });
 }
 
 // Active Status Circle
 function activeStatusCircle() {
     return `<span class="activeStatus"></span>`;
 }
 
 /**
  *-------------------------------------------------------------
  * Set Active status
  *-------------------------------------------------------------
  */
 function setActiveStatus(status, user_id) {
     $.ajax({
         url: url + "/setActiveStatus",
         method: "POST",
         data: { _token: access_token, user_id: user_id, status: status },
         dataType: "JSON",
         success: (data) => {
             // Nothing to do
         },
         error: () => {
             console.error("Server error, check your response");
         },
     });
 }
 
 /**
  *-------------------------------------------------------------
  * Trigger seen event
  *-------------------------------------------------------------
  */
 function makeSeen(status) {
     // remove unseen counter for the user from the contacts list
     // $(".messenger-list-item[data-contact=" + getMessengerId + "]")
     //     .find("tr>td>b")
     //     .remove();
     // seen
 
     $.ajax({
         url: url + "/makeSeen",
         method: "POST",
         data: { _token: access_token, id: getMessengerId },
         dataType: "JSON",
         // success: data => {
         //     console.log("[seen] Messages seen - " + getMessengerId());
         // }
     });
     return channel.trigger("client-seen", {
         from_id: auth_id, // Me
         to_id: getMessengerId, // Messenger
         seen: status,
     });
 }
 
 // Listen to messages, and append if data received
 channel.bind("messaging", function (data) {
     if (data.from_id == getMessengerId && data.to_id == auth_id) {
         console.log(data);
         console.log("auth_id", parseInt(auth_id));
         console.log("mId", getMessengerId);
 
         const { message } = data;
         console.log("recieved data", message);
         $(".messages-container").find(".messages").append(message);
         scrollBottom();
         makeSeen(true);
     }
 });
 
 // listen to typing indicator
 channel.bind("client-typing", function (data) {
     if (data.from_id == getMessengerId && data.to_id == auth_id) {
         data.typing == true
             ? messagesContainer.find(".typing-indicator").show()
             : messagesContainer.find(".typing-indicator").hide();
     }
     // scroll to bottom
     scrollBottom(messagesContainer);
 });
 
 // presence channel [User Active Status]
 var activeStatusChannel = pusher.subscribe("presence-activeStatus");
 
 // Joined
 activeStatusChannel.bind("pusher:member_added", function (member) {
     setActiveStatus(1, member.id);
     $(".messenger-list-item[data-contact=" + member.id + "]")
         .find(".activeStatus")
         .remove();
     $(".messenger-list-item[data-contact=" + member.id + "]")
         .find(".avatar")
         .before(activeStatusCircle());
 });
 
 // listen to seen event
 channel.bind("client-seen", function (data) {
     if (data.from_id == getMessengerId && data.to_id == auth_id) {
         if (data.seen == true) {
             $(".message-time")
                 .find(".fa-check")
                 .before('<span class="fas fa-check-double seen"></span> ');
             $(".message-time").find(".fa-check").remove();
             console.info("[seen] triggered!");
         } else {
             console.error("[seen] event not triggered!");
         }
     }
 });
 
 // Leaved
 activeStatusChannel.bind("pusher:member_removed", function (member) {
     setActiveStatus(0, member.id);
     $(".messenger-list-item[data-contact=" + member.id + "]")
         .find(".activeStatus")
         .remove();
 });
 
 /**
  *-------------------------------------------------------------
  * Trigger typing event
  *-------------------------------------------------------------
  */
 function isTyping(status) {
     return channel.trigger("client-typing", {
         from_id: auth_id, // Me
         to_id: getMessengerId, // Messenger
         typing: status,
     });
 }
 
 /**
  *-------------------------------------------------------------
  * Check internet connection using pusher states
  *-------------------------------------------------------------
  */
 function checkInternet(state, selector) {
     let net_errs = 0;
     const messengerTitle = $(".messenger-headTitle");
     switch (state) {
         case "connected":
             if (net_errs < 1) {
                 messengerTitle.text(messengerTitleDefault);
                 selector.addClass("successBG-rgba");
                 selector.find("span").hide();
                 selector.slideDown("fast", function () {
                     selector.find(".ic-connected").show();
                 });
                 setTimeout(function () {
                     $(".internet-connection").slideUp("fast");
                 }, 3000);
             }
             break;
         case "connecting":
             messengerTitle.text($(".ic-connecting").text());
             selector.removeClass("successBG-rgba");
             selector.find("span").hide();
             selector.slideDown("fast", function () {
                 selector.find(".ic-connecting").show();
             });
             net_errs = 1;
             break;
         // Not connected
         default:
             messengerTitle.text($(".ic-noInternet").text());
             selector.removeClass("successBG-rgba");
             selector.find("span").hide();
             selector.slideDown("fast", function () {
                 selector.find(".ic-noInternet").show();
             });
             net_errs = 1;
             break;
     }
 }
 
 /**
  *-------------------------------------------------------------
  * Get shared photos
  *-------------------------------------------------------------
  */
 function getSharedPhotos(user_id) {
     $.ajax({
         url: url + "/shared",
         method: "POST",
         data: { _token: access_token, user_id: user_id },
         dataType: "JSON",
         success: (data) => {
             $(".shared-photos-list").html(data.shared);
         },
         error: () => {
             console.error("Server error, check your response");
         },
     });
 }
 
 /**
  *-------------------------------------------------------------
  * Delete Conversation
  *-------------------------------------------------------------
  */
 function deleteConversation(id) {
     $.ajax({
         url: url + "/deleteConversation",
         method: "POST",
         data: { _token: access_token, id: id },
         dataType: "JSON",
         beforeSend: () => {
             // hide delete modal
             app_modal({
                 show: false,
                 name: "delete",
             });
             // Show waiting alert modal
             app_modal({
                 show: true,
                 name: "alert",
                 buttons: false,
                 body: loadingSVG("32px", null, "margin:auto"),
             });
         },
         success: (data) => {
             // delete contact from the list
             $(".listOfContacts")
                 .find(".messenger-list-item[data-contact=" + id + "]")
                 .remove();
             // refresh info
             IDinfo(id, getMessengerType);
 
             data.deleted ? "" : console.error("Error occured!");
 
             // Hide waiting alert modal
             app_modal({
                 show: false,
                 name: "alert",
                 buttons: true,
                 body: "",
             });
         },
         error: () => {
             console.error("Server error, check your response");
         },
     });
 }
 
 ChatInitator.on("click", function () {
     document.querySelector("#vicomma-chat-module").style.display = "block";
 });
 
 const Index = () => {
     const [messages, setMessages] = useState([]); // messages array
     const [close, setClose] = useState(false); //handle closing the chat widget
     const [display, setDisplay] = useState(false); //handle display of the chat widget
     const [send, setSend] = useState(false); //handle sending of the chat widget
 
     useEffect(() => {
         if (close) {
             document.querySelector("#vicomma-chat-module").style.display =
                 "none";
         }
     }, [close]);
 
     useEffect(() => {
         //fetch messages
         const fetchMessages = async () => {
             let formData = new FormData();
             formData.append("_token", access_token);
             formData.append("id", getMessengerId);
             formData.append("type", getMessengerType);
             formData.append("page", "1");
             const response = await fetch(FETCH_MESSAGES_ENDPOINT, {
                 method: "post",
                 body: formData,
             });
             const data = await response.json();
             console.log(data.messages);
             setMessages(data.messages);
         };
 
         fetchMessages();
 
         return () => {
             pusher.unsubscribe("private-chatify");
             pusher.unsubscribe("presence-activeStatus");
         };
 
         // eslint-disable-next-line react-hooks/exhaustive-deps
     }, []);
 
     return (
         <PageProvider>
             <JobProvider mx_id={mx_id}>
                 <ChatProvider
                     messages={messages}
                     setMessages={setMessages}
                     close={close}
                     setClose={setClose}
                 >
                     <div className="ChatApp">
                         <Suspense fallback={<div>Loading...</div>}>
                             <Header />
                             <Action
                                 text={<JobTitle />}
                                 action={<MajorAction />}
                             />
                         </Suspense>
                         <Suspense fallback={<div>Loading...</div>}>
                             <MessageDisplay messages={messages} />
                         </Suspense>
                     </div>
                 </ChatProvider>
             </JobProvider>
         </PageProvider>
     );
 };
 
 const JobTitle = () => {
     return (
         <JobContext.Consumer>
             {({ currentJob }) => {
                 console.log(currentJob.jobName);
                 return <span>{currentJob.jobName}</span>;
             }}
         </JobContext.Consumer>
     );
 };
 
 if (document.getElementById("vicomma-chat-module")) {
     render(
         <StrictMode>
             <Index />
         </StrictMode>,
         document.getElementById("vicomma-chat-module")
     );
 }
 
 if (document.getElementById("vicomma-chat-module-final")) {
     render(
         <StrictMode>
             <Index />
         </StrictMode>,
         document.getElementById("vicomma-chat-module-final")
     );
 }
 
 export default Index;