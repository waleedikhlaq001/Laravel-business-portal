<template>
  <div id="individual-chat">
    <!-- <header class="clearfix" >
      <a href="#" class="individual-chat-close"><i class="fa fa-close"></i></a>



    </header> -->

    <header class="clearfix" >
      <div id="chatLoadingTobe"><div class="loader-sm"></div></div>
      <a href="#" class="individual-chat-close"><i class="fa fa-close"></i></a>

      <h4 v-if="this.individualVendor.id == userProp">
        <span class="hideShow">
            {{ this.individualInfluencer.first_name }}
            {{ this.individualInfluencer.last_name }} <br />
            <span class="ml-3">{{ this.individualJob.name }}</span>
        </span>

      </h4>

      <h4 v-else>
        <span class="hideShow">

          {{ this.individualVendor.first_name }}
          {{ this.individualVendor.last_name }} <br />
          <span class="ml-3">{{ this.individualJob.name }}</span>

        </span>
      </h4>

    </header>


    <div class="individual-chat">
      <div id="chatContentLoadingTobe">
          <div class="loader-md center-align" style="top:40%;left:40%;"></div>
      </div>

      <div class="btnDiv justify-content-end" v-if="this.individualVendor.id == userProp">
        <div class="float-right" v-if="this.individualJob.isAwarded && this.individualJob.isCompleted == 0">

            <form action="/dispute" method="get" v-if="this.individualMilestone" >
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="job_id" :value="individualJob.id">
                <input type="submit" value="Dispute" class="disputeBtn mr-2">
            </form>

            <a href="javascript:void(0)" class="milestoneBtn text-white" v-if="this.individualMilestone" @click="redirectMilestone()">
                Pay Milestone <b> {{individualMilestone.currency+''+individualMilestone.amt_due}}</b>
            </a>

        </div>
        <div class="float-right" v-else>
            <div  v-if="this.individualJob.isCompleted == 0 && !this.individualJob.isAwarded">
            <form action="/jobs/bid/award" method="post">
                <input type="hidden" name="influencer_id" :value="individualInfluencer.id">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="bid_id" :value="individualBid.id">
                <input type="hidden" name="job_id" :value="individualJob.id">
                <input type="hidden" name="bid_amount" :value="individualBid.amount">

                <input type="submit" value="Award" class="awardBtn mt-3">
            </form>
            </div>
        </div>


      </div>

      <div class="individual-chat-history px-3 hide" id="noIndividualMessage" v-if="this.individualChat.length>0">
        <h6 class="text-center mt-3">No message sent yet, Send a message</h6>
      </div>

      <div class="individual-chat-history mainDiv fine-scrollbar">


        <div class="">
          <div v-for="data in this.individualChat" :key="data.id" :class="data.receiver == userProp?'text-left d-flex my-2':'text-right d-flex my-2'">
          <!-- <img
            :src="data.image"
            alt="image"
            class="mr-2 imgchat"
          /> -->


          <div :class="data.sender == userProp? 'senderDiv px-2': 'receiverDiv px-2'">
            <h6 :class="data.sender == userProp? 'text-white text-left mb-0': 'text-left mb-0'" style="font-size:10px;">{{data.message}}</h6>
            <span :class="data.sender == userProp?'individual-chat-time mt-1 text-white text-right':'individual-chat-time mt-1 text-right'">{{data.created_at | setDate}}</span>
          </div>

          <!-- <div class="" v-if="data.sender == userProp">
            <p class="text-white text-left mb-0">
              {{data.message}}
            </p>
            <span class="individual-chat-time mt-0 text-white text-right"
              >{{data.time}}</span
            >
          </div> -->
          <!-- end chat-message-content -->
        </div>
        <!-- end chat-message -->
        </div>


      </div>
      <!-- end chat-history -->

        <fieldset class="d-flex" style="padding:7px;">
          <input
            type="text"
            placeholder="Enter Message Here"
            id="chat-message-box"
            @keyup.enter="submitMessage"
            autofocus
            autocomplete="off"
            v-model="message"
          />
          <button
            @click="submitMessage"
            id="chat-send-btn"
            class="fa fa-paper-plane ml-1 mt-1 border-0"
          ></button>

          <div id="messageSending" class="hide mt-2 ml-2"><div class="loader-sm"></div></div>

        </fieldset>
    </div>
    <!-- end chat -->
  </div>
  <!-- end individual-chat -->
</template>

<script>
import { mapGetters, mapActions } from "vuex";
var moment = require("moment");


Vue.filter("setDate", function (value) {
  if (value) {
    return moment(String(value)).format("ddd, h:mmA");
  }
});

export default {
  props: ["userProp"],
  data() {
    return {
      message: "",
      dataFetch:true,
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
  },
  computed: {
    ...mapGetters([
      "individualChat",
      "individualInfluencer",
      "individualJob",
      "individualBid",
      "individualVendor",
      "individualMilestone"
    ]),
  },
  created() {

  },
  methods: {
    ...mapActions(["submitVendorMessage", "getAllChatData", 'getIndividualChatData']),
    connect(){
        let vm= this;
        this.getIndividualChatData({bid:this.individualBid.id, user:this.userProp});

        window.Echo.private("chat")
        .listen('NewMessageSent', (e) =>{
          console.log('message side')
            vm.getIndividualChatData({bid:this.individualBid.id, user:this.userProp});
            vm.getAllChatData(this.userProp);
        })

    },
    async submitMessage(e) {
      e.preventDefault();



      if (this.message == "") {
        return;
      }

      // this.individualChat.push({
      //   message:this.message,
      //   time: new Date().toString().substring(0,14),
      //   sender:this.userProp
      // })

      $('#chat-send-btn').hide();
      $("#messageSending").removeClass('hide');


      await this.submitVendorMessage({
        message: this.message,
        bid: this.individualBid.id,
        receiver: this.individualInfluencer.id,
        job: this.individualJob.id,
        user: this.userProp,
      });
        this.message = "";

        $('#chat-send-btn').show();
        $("#messageSending").addClass('hide');

        this.connect();
        $('#noIndividualMessage').addClass('hide');
        $('#noIndividualMessage').fadeOut('fast');
        this.getIndividualChatData({bid:this.individualBid.id, user:this.userProp});
        this.getAllChatData(this.userProp);
    },

    redirectMilestone(){
      window.location = '/milestone/'+this.individualMilestone.uid+'/pay';
    }
  },

  mounted() {
    this.connect();

    if(this.individualChat.length < 1){

        $('#noIndividualMessage').removeClass('hide');

    }

  },
};
</script>

<style>
/* ---------- INDIVIDUAL-CHAT ---------- */

.btnDiv{
    background: #d4d4d4 !important;
    top: 55px;
    left: 0;
    width: 100%;
    height: 35px;
    position: absolute;
    padding: 5px;
    display: flex;
    align-items: center;
}

.awardBtn,.milestoneBtn{
  background:#6f3c96;
  padding:2px 10px;
  color:white;
  border:none;
  border-radius: 7px;
}

.disputeBtn{
  background:#dede9c;
  padding:2px 10px;
  color:black;
  border:none;
  border-radius: 7px;
}

#chatLoadingTobe{
  position: absolute;
  left: 40px;
  top: 15px;
}
#individual-chat {
  bottom: 0;
  left: calc(100vw - 714px) !important;
  font-size: 12px;
  position: fixed;
  width: 300px;
  z-index: 2;
}

#individual-chat header {
  background: #293239;
  border-radius: 5px 5px 0 0;
  color: #fff;
  cursor: pointer;
  padding: 16px 24px;
}

#individual-chat h4:before {
  background: #00d331;
  border-radius: 50%;
  content: "";
  display: inline-block;
  height: 8px;
  margin: 0 8px 0 0;
  width: 8px;
}

#individual-chat h4 {
  font-size: 12px;
}

#individual-chat h5 {
  font-size: 10px;
}

#individual-chat form {
  padding: 24px;
}

#individual-chat input[type="text"] {
  border: 1px solid #ccc;
  border-radius: 3px;
  padding: 8px;
  outline: none;
  width: 234px;
}

.individual-chat-message-counter {
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

.fa {
  font-size: 20px !important;
}

.individual-chat-close {
  background: #1b2126;
  border-radius: 50%;
  color: #fff;
  display: block;
  float: right;
  font-size: 20px !important;
  height: 16px;
  line-height: 16px;
  margin: 2px 0 0 0;
  text-align: center;
  width: 16px;
}

.imgchat {
  width: 30px;
  height: 30px;
  border-radius: 50%;
}

.individual-chat {
  background: #fff;
}

.individual-chat-history {
  height: 282px;
padding: 30px 2px 0px 2px;
  overflow-y: scroll;
}

.receiverDiv {
  max-width: calc(100% - 60px) !important;
  border-radius: 10px;
  background-color: #fdfdfd;
  border: 1px solid #6f3c96;
  padding: 5px 0px;

}

.senderDiv {
  max-width: calc(100% - 60px) !important;
  margin-left: auto;
  border-radius: 10px;
  background-color: #6f3c96;
  padding: 5px 0px;

}

.individual-chat-time {
  float: right;
  font-size: 10px;
}

.individual-chat-feedback {
  font-style: italic;
}
</style>
