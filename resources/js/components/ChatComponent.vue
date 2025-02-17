<template>
    <div id="live-chat">

        <header class="clearfix">


            <a href="#" class="chat-close"><i class="fa fa-angle-down"></i></a>

            <h4>Chats  <i class="fa fa-exclamation-circle" style="font-size: 15px !important" aria-hidden="true"  data-toggle="popover" data-bs-trigger="hover" title="Chat Disclaimer" data-bs-content="This chat session is not being recorded by your host in order to provide anonimity and privacy of your
transaction; this being the case, it is requested, respectfully that you adhere to every and all compliance
details"></i></h4>


            <span class="chat-message-counter" v-if="this.unreadCount>0">{{this.unreadCount}}</span>




        </header>

        <div class="chat">


            <div class="chat-history fine-scrollbar">

                <div id="allChatContentLoadingTobe">
                    <div class="loader-md center-align" style="top:40%;left:40%;"></div>
                </div>

                <div class="px-3 hide" id="noAllChatMessage">
                    <h6 class="text-center mt-3">No message sent yet, Send a message</h6>
                </div>


                <div v-for="data in this.allChatData" :key="data.bid.id" @click="fetchChats(data.bid.id)" class="chat-message clearfix" style="cursor:pointer;">
                    <img v-if="data.sender != 'user' " :src="data.sender.image" alt="" width="32" height="32">
                    <img v-if="data.receiver != 'user' " :src="data.receiver.image" alt="" width="32" height="32">

                    <div class="chat-message-content clearfix d-flex justify-content-between">


                        <div>
                            <h5 style="font-weight:700;color:#000;">{{data.job_name}}</h5>
                            <h5  class="mt-2" style="margin-bottom:2px;color: #555;" v-if="data.sender != 'user' ">{{data.sender.first_name}} {{data.sender.last_name}} </h5>

                            <h5  class="mt-2" style="margin-bottom:2px;color: #555;" v-if="data.receiver != 'user' ">{{data.receiver.first_name}} {{data.receiver.last_name}} </h5>

                            <h6 class="m-0" style="font-size:10px;color: #555;">{{data.chat.message}}</h6>
                        </div>

                        <div class="text-right align-self-end ml-auto">
                            <span class="chat-time">{{data.chat.created_at | formatDate}}</span>
                        </div>

                    </div> <!-- end chat-message-content -->

                    <hr class="mt-1 mb-0">

                </div> <!-- end chat-message -->





            </div> <!-- end chat-history -->


        </div> <!-- end chat -->

    </div> <!-- end live-chat -->


</template>


<script>
import { mapGetters, mapActions } from "vuex";
var moment = require("moment");


Vue.filter("formatDate", function (value) {
  if (value) {
    return moment(String(value)).format("MMM Do, h:mmA");
  }
});

export default {
  props: ["userProp", "bidProp"],
  data() {
    return {
      count: 0,
      chat: false,
    };
  },
  computed: {
    ...mapGetters([
      "allChatData",
      "individualVendor",
      "individualChat",
      "unreadCount"

    ]),
  },
  methods: {
    ...mapActions(["getAllChatData", "getIndividualChatData"]),

    async fetchChats(bid){
        $('#individual-chat').fadeIn();
        $('.mainDiv').removeClass('hide');
        $('#chatLoadingTobe').show();
        $('#chatContentLoadingTobe').show();
        $('#noIndividualMessage').addClass('hide');



        $('.hideShow').hide();

        await this.getIndividualChatData({bid:bid, user:this.userProp});

        if(this.individualChat.length <1){
            $('#noIndividualMessage').removeClass('hide');
            // $('.mainDiv').addClass('hide');
            return;
        }

        if(this.individualVendor.id != this.userProp){
            $('.individual-chat-history').css('padding', '0px ,2px');
        }

        $('#chatLoadingTobe').hide();
        $('#chatContentLoadingTobe').hide();
        $('.mainDiv').removeClass('hide');

        $('.hideShow').show();

        var pos = $('.individual-chat-history').offset().top + 10000000;
        $('#individual-chat, .individual-chat-history').animate({ scrollTop:pos }, 1000);
        this.chat=false;
        this.getAllChatData(this.userProp);

    },


  },

  mounted() {

    this.getAllChatData(this.userProp);

    $('.chat-message').on('click', function(){
        // do ajax to get messages and populate message div
        $('#individual-chat').fadeIn('fast');
        var pos = $('.individual-chat-history').offset().top + 100000;
        $('#individual-chat, .individual-chat-history').animate({ scrollTop:pos }, 1000);
    })





  },
};
</script>

<style>
/* ---------- LIVE-CHAT ---------- */

            #live-chat {
                bottom: 0;
                font-size: 12px;
                right: 88px;
                position: fixed;
                width: 300px;
                z-index: 2;
            }




            #live-chat header {
                background: #293239;
                border-radius: 5px 5px 0 0;
                color: #fff;
                cursor: pointer;
                padding: 16px 24px;
            }

            #live-chat h4:before {
                background: #00d331;
                border-radius: 50%;
                content: "";
                display: inline-block;
                height: 8px;
                margin: 0 8px 0 0;
                width: 8px;
            }

            #live-chat h4 {
                font-size: 12px;
            }

            #live-chat h5 {
                font-size: 10px;
            }

            #live-chat form {
                padding: 24px;
            }

            #live-chat input[type="text"] {
                border: 1px solid #ccc;
                border-radius: 3px;
                padding: 8px;
                outline: none;
                width: 234px;
            }

            .chat-message-counter {
                background: #e62727;
                border: 1px solid #fff;
                border-radius: 50%;
                display: none;
                font-size: 12px;
                font-weight: bold;
                height: 28px;
                left: 0;
                line-height: 28px;
                margin: -15px 0 0 -15px;
                position: absolute;
                text-align: center;
                top: 0;
                width: 28px;
            }

            .chat-close {
                border-radius: 50%;
                color: #fff;
                display: block;
                float: right;
                font-size: 10px;
                height: 16px;
                line-height: 16px;
                margin: 2px 0 0 0;
                text-align: center;
                width: 16px;
                transition: all 0.4s;
                transform: rotateZ(180deg);
            }
            .chat-close:hover, .individual-chat-close:hover{
                color:#00d331;
            }

            .chat-close.close{
                transform: rotateZ(0deg);
            }

            .chat {
                background: #fff;
                border-left: 1px solid #6633991a;
                border-right: 1px solid #6633991a;
            }

            .chat-history {
                height: 337px;
                width: 100%;
                padding: 4px 0px 4px 6px;
                overflow-y: scroll;
            }

            .chat-message {
                margin: 6px 0;
            }

            .chat-message img {
                border-radius: 50%;
                float: left;
            }

            .chat-message-content {
                margin-left: 56px;
            }

            .chat-time {
                float: right;
                font-size: 10px;
            }

            .chat-feedback {
                font-style: italic;
                margin: 0 0 0 80px;
            }

</style>
