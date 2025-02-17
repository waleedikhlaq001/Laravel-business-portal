<template>
  <a :href="notiLink">
    <div :class="newAlert?'noti-alert active noti-alert-primary px-3':'noti-alert noti-alert-primary px-3'">
      <p>
            {{message}} <br>

            <span class="text-center">
              ({{details}})
            </span>

      </p>

      <i class="fa fa-close cancel" @click="hideMe()"></i>
    </div>
  </a>

</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  props: ["userProp", "userRole"],
  data() {
    return {
      newAlert:false,
      message:'No New Notification',
      notiLink:'',
      details:'',
    };
  },
  computed: {
    ...mapGetters([
      "individualChat",
      "individualBid",


    ]),
  },
  watch: {
    // whenever question changes, this function will run
    individualChat() {
      this.connect();
    }
  },
  created() {

  },
  methods: {
    ...mapActions(["submitVendorMessage", "getAllChatData", 'getIndividualChatData','getUserNotifications']),

    toggleAlertBox(){
      setInterval(()=>{
        this.newAlert = !this.newAlert;
      }, 5000)
    },

    hideMe(){
      this.newAlert = false;
    },
    connect(){
        let vm= this;
        setTimeout(()=>{
          window.Echo.private("new-notification")
          .listen('NewNotification', (e) =>{

              console.log('noti side')

              if(e.notification.type == 'chat' && e.notification.receiver == vm.userProp){
                vm.getIndividualChatData({bid:vm.individualBid.id, user:this.userProp});
                vm.message = 'New message From '+ e.user.first_name+' '+e.user.last_name;
                vm.details = e.notification.message;
                vm.newAlert = true;
                vm.getUserNotifications(this.userProp);
                vm.getAllChatData(this.userProp);
                $('#noAllChatMessage').addClass('hide');





              }else if(e.notification.type == 'bid' && e.notification.receiver == vm.userProp){
                vm.message = 'Your Job has a new bid';
                vm.details = e.notification.message;
                vm.notiLink = '/jobs/details/'+e.notification.type_id;
                vm.newAlert = true;
                vm.getUserNotifications(this.userProp);



              }else if(e.notification.type == 'award' && e.notification.receiver == vm.userProp){
                vm.message = e.user.first_name+' '+e.user.last_name+' Has Awarded A job To You';
                vm.details = e.notification.message;
                vm.notiLink = '/jobs/details/'+e.notification.type_id;
                vm.newAlert = true;
                vm.getUserNotifications(this.userProp);



              }else if(e.notification.type == 'Wallet' && e.notification.receiver == vm.userProp){
                vm.message = e.user.first_name+' '+e.user.last_name+' Has Credited Your Wallet';
                vm.details = e.notification.message;
                vm.notiLink = '/jobs/details/'+e.notification.type_id;
                vm.newAlert = true;
                vm.getUserNotifications(this.userProp);



              }else if(e.notification.type == 'job' && this.userRole == 'influencer'){

                vm.message = 'New job posted, check job section for details';
                vm.details = e.notification.message;
                vm.notiLink = '/jobs/details/'+e.notification.type_id;
                vm.newAlert = true;
                vm.getUserNotifications(this.userProp);



              }else if(e.notification.type == 'videoUpload' && e.notification.receiver == vm.userProp){

                vm.message = 'New video uploaded for your job';
                vm.details = e.notification.message;
                vm.notiLink = '/jobs/details/'+e.notification.type_id;
                vm.newAlert = true;
                vm.getUserNotifications(this.userProp);
              }



          })
        }, 4000)

        setTimeout(()=>{
          this.hideMe();

        },6000)



    },


  },
  mounted() {
    // this.toggleAlertBox()
    this.connect();
  },
};
</script>

<style scoped>

  .noti-alert.active{
     animation: rightToLeft 5s linear;
  }

  @keyframes rightToLeft {
    0%{
      transform: translateX(150px);
      opacity: 1;
    }
    5%{
      transform: translateX(80px);
      opacity: 1;
    }
    10%{
      transform: translateX(30px);
      opacity: 1;
    }
    15%{
      transform: translateX(0);
      opacity: 1;
    }
    25%{
      transform: translateX(0);
      opacity: 1;
    }
    50%{
      transform: translateX(0);
      opacity: 1;
    }
    75%{
      transform: translateX(0);
      opacity: 1;
    }
    80%{
      transform: translateX(0);
      opacity: 1;
    }
    85%{
      transform: translateX(30px);
      opacity: 1;
    }
    90%{
      transform: translateX(80px);
      opacity: 1;
    }
    95%{
      transform: translateX(150px);
      opacity: 1;
    }
    100%{
      transform: translateX(200px);
      opacity: 0;
    }
  }

  .noti-alert{
    position: absolute;
    z-index: 2;
    right: 8px;
    transform: translateX(200px);
    top: 110px;
    min-width: 200px;
    background: #dee3fa;
    max-width: 400px;
    height: 100px;
    margin-bottom: 1rem;
    border: 1px solid purple;
    border-radius: 0.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
  }

  p{
    font-size:14px;
    margin:auto;
  }

  .cancel{
    position: absolute;
    right:2px;
    top:2px;
    font-size:13px;
    color:var(--snd-color);
    cursor:pointer;
  }
</style>
