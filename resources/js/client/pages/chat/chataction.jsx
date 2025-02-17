import React, { useEffect, useState, useRef, Fragment } from "react";
import useMediaQuery from "@mui/material/useMediaQuery";
// import Picker from "emoji-picker-react";
import smiley from "./smiley.svg";
import clip from "./clip.svg";
import send from "./send.svg";
import { PAGE_SEND_MESSAGE_ENDPOINT } from "./constant";

var temporaryMsgId = 0;
const ChatAction = () => {
    const matches = useMediaQuery("(max-width:768px)");
    const ref = useRef(null);
    const [chosenEmoji, setChosenEmoji] = useState(null);

    const onEmojiClick = (event, emojiObject) => {
        setChosenEmoji(emojiObject);
    };

    const sendMessage = (message) => {
        temporaryMsgId += 1;
        console.log("you sent a message");
        fetch(PAGE_SEND_MESSAGE_ENDPOINT, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                _token: tkon,
                id: parseInt($("#chat-initiator").attr("data-chatreceiver")), //send message to myself
                type: "user",
                actor: parseInt(actor),
                message: message,
                temporaryMsgId: `temp_${temporaryMsgId}`,
            }),
        })
            .then((data) => data.json())
            .then((data) => {
                console.log("entry point return", data);
                $(".messages-container").find(".messages").append(data.message);
                $(".messages-container").animate({
                    scrollTop: $(".messages-container")[0].scrollHeight,
                });
                $(".message-entry-point").val("");
            });
    };

    const handleSend = async (e) => {
        console.log(e.target.value);
        if (e.which == 13 || e.keyCode === 13) {
            if (!e.shiftKey) {
                // triggered = isTyping(false);
                sendMessage(e.target.value);
            }
        }
    };
    // useEffect(() => {}, []);
    return (
        <Fragment>
            <div className="chatActions">
                <div className="chat-action-btns">
                    <img src={smiley} alt="smiley" />
                    <input
                        ref={ref}
                        className="message-entry-point"
                        type="text"
                        size={matches ? "30" : "35"}
                        placeholder="Type a message..."
                        onKeyUp={(e) => handleSend(e)}
                    />
                    <div className="chat-action-right">
                        <img src={clip} alt="clip" />
                        <img
                            src={send}
                            alt="send"
                            onClick={() => sendMessage(ref.current.value)}
                        />
                    </div>
                </div>
            </div>
        </Fragment>
    );
};

export default ChatAction;
