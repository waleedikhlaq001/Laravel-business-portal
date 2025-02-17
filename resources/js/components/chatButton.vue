<template>
    <button id="vicomma-chat-btn" :class="!awardProp? 'btn btn-secondary mt-2 me-3 chat-message': 'btn-sm mx-1 btn-default my-1 side-btn chat-message text-bold'" @click="fetchChats">Chat</button>
</template>

<script>
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';

    export default {
        data() {
            return {
                chats:[],
                influencer:[],
                job:[],
            }
        },
        props: ['bidProp', 'userProp', 'awardProp'],
        computed: {
            ...mapGetters([
            "allChatData",
            "individualVendor",
            "individualChat"

            ]),
        },
        methods: {

            ...mapActions(['getIndividualChatData']),
            async fetchChats(){
                $('.mainDiv').removeClass('hide');
                $('#chatLoadingTobe').show();
                $('#chatContentLoadingTobe').show();
                $('#individual-chat').fadeIn('fast');
                $('#noIndividualMessage').addClass('hide');


                await this.getIndividualChatData({bid:this.bidProp, user:this.userProp});

                if(this.individualChat.length<1){
                    $('#noIndividualMessage').removeClass('hide');
                    // $('.mainDiv').addClass('hide');
                }


                $('#individual-chat, .individual-chat-history').animate({ scrollTop:pos }, 1000);
                var pos = $('.individual-chat-history').offset().top + 10000000;
                $('#chatLoadingTobe').hide();
                $('#chatContentLoadingTobe').hide();



                this.chat=false;




            }
        },
        mounted() {
            //  $('.chat-message').on('click', function(){
            //     // do ajax to get messages and populate message div
            //     $('#individual-chat').fadeIn('fast');
            //     var pos = $('.individual-chat-history').offset().top + 10000000;
            //     $('#individual-chat, .individual-chat-history').animate({ scrollTop:pos }, 1000);
            // })

        }
    }
</script>
