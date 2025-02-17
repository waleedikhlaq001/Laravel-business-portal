import axios from 'axios';
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    allChatData: [],
    unreadCount: 0,
    individualChat:[],
    individualInfluencer:[],
    individualVendor:[],
    individualJob:[],
    individualBid:[],
    userNotifications:[],
    individualMilestone:[],
    notiCount:0,
    allBids:[],
    bidJob:[],
    bidVendor:[]
  },
  getters: {
    individualChat: (state)=>state.individualChat,
    individualJob: (state)=>state.individualJob,
    individualInfluencer: (state)=>state.individualInfluencer,
    individualBid: (state)=>state.individualBid,
    individualVendor: (state)=>state.individualVendor,
    individualMilestone: (state)=>state.individualMilestone,
    allChatData:(state)=>state.allChatData,
    unreadCount:(state)=>state.unreadCount,
    userNotifications:(state)=>state.userNotifications,
    notiCount:(state)=>state.notiCount,
    allBids:(state)=>state.allBids,
    bidJob:(state)=>state.bidJob,
    bidVendor:(state)=>state.bidVendor,

  },
  actions:{

    async getIndividualChatData({ commit }, params){
        var pos = $('.individual-chat-history').offset().top + 10000000;
        $('#individual-chat, .individual-chat-history').animate({ scrollTop:pos }, 1000);
        const wait = await axios.get('/api/chats/vendor/individual/get',{ params: { bid: params.bid, user:params.user } });
        var parsedobj = JSON.parse(JSON.stringify(wait))

        commit('indInfluencer', parsedobj.data.influencer);
        commit('indChat', parsedobj.data.chats);
        commit('indJob', parsedobj.data.job);
        commit('indBid', parsedobj.data.bid);
        commit('indVendor', parsedobj.data.vendor);
        commit('indMilestone', parsedobj.data.milestone);

    },
    async submitVendorMessage({ commit }, body){
        const sent = await axios.post('/api/chats/store', {
            bid:body.bid,
            job:body.job,
            inf:body.receiver,
            message:body.message,
            user:body.user,

        })
    },
    async getAllChatData({ commit }, user){
        const wait = await axios.get('/api/chats/get',{ params: {user:user} });

        var unreadChats = 0;

        if(wait.data.length == 0){
          $('#noAllChatMessage').removeClass('hide');
        }

        for(var i=0; i<wait.data.length; i++){
          if(wait.data[i].chat.status == 0){
            unreadChats += 1;
          }

          // console.log(wait.data[i].chat.status);
        }
        $('#allChatContentLoadingTobe').hide();

        commit('allChatData', wait.data);
        commit('unreadCount', unreadChats);


        var pos = $('.individual-chat-history').offset().top + 10000000;
        $('#individual-chat, .individual-chat-history').animate({ scrollTop:pos }, 1000);


    },

    async getUserNotifications({ commit }, user){
      const notis = await axios.get('/api/notifications/get',{ params: { user:user } });
      let newData = [];

      setTimeout(() => {

        newData = notis.data.notifications.sort((a,b) => {
            if (a.created_at < b.created_at) {
                return 1;
            } else {
                return -1;
            }
        });
        commit('userNotifications', newData);
      },1000);

      commit('notiCount', notis.data.count);
    },

    async markNotification({ commit }, user){
      const notis = await axios.get('/api/notifications/mark',{ params: { user:user } });
    },

    async getJobBids({ commit }, payload){
      const bidsData = await axios.get('/api/job/bids/get',{ params: { user:payload.user, job:payload.job} });

      commit('allBids', bidsData.data.bids);
      commit('bidJob', bidsData.data.job);
      commit('bidVendor', bidsData.data.vendor);

    },

    async submitDispute({ commit }, body){
        const sent = await axios.post('/dispute/register', {
            message:body.message,
            job_id:body.job_id,
        })

        return sent;
    },


},
  mutations: {
    indInfluencer: (state, inv)=> (state.individualInfluencer = inv),
    indChat: (state, res) => (state.individualChat = res),
    indJob: (state, allInv)=> (state.individualJob = allInv),
    indBid: (state, bid)=> (state.individualBid = bid),
    indVendor: (state, vendor)=> (state.individualVendor = vendor),
    indMilestone: (state, milestone)=> (state.individualMilestone = milestone),
    allChatData: (state, data)=> (state.allChatData = data),
    unreadCount: (state, data)=> (state.unreadCount = data),
    userNotifications:(state,notiData)=>(state.userNotifications = notiData),
    notiCount:(state,notiCount)=>(state.notiCount = notiCount),
    allBids: (state, bids)=> (state.allBids = bids),
    bidJob: (state, job) => (state.bidJob = job),
    bidVendor: (state, vendor)=> (state.bidVendor = vendor),
  }
})

export default store;
