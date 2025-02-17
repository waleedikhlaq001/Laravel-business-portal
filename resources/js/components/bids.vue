<template>
<div id="bid-cont">
    <div class="row g-3 bids" v-if="allBids.length>0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card jbCardContainer p-1 bg-transparent">
                <div class="row justify-content-center g-2">
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="bg-white rounded-0 p-2 bid-header">
                            <h6>Budget:
                                <span>{{bidJob.currencySymbol}}{{bidJob.budget.min}} - {{bidJob.currencySymbol}}{{bidJob.budget.max}}</span>
                            </h6>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="bg-white rounded-0 p-2 bid-header">
                            <h6>Bids:
                                <span>{{ allBids.length }}</span>
                            </h6>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="bg-white rounded-0 p-2 bid-header">
                            <h6>Avg. Bid:
                                <span>{{ bidJob.currencySymbol }}{{ Math.round(bidJob.bid_average) }}</span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow p-2 bg-white pb-3" v-for="(bid,index) in allBids" :key="index">
                <div class="unawarded-bid" v-if="bidJob.isAwarded && bidJob.bid_id != bid.id"></div>
                <div class="card-header d-sm-block d-lg-flex justify-content-between border-bottom-0 pb-1">
                    <div class="d-flex align-items-center">
                        <div class="bdImage" v-on:mouseover="bidHovered(index)" v-on:mouseleave="bidLeft(index)">
                            <img :src="bid.influencerObj.image" class="img-fluid" alt="$bid->influencer->last_name">

                            <div class="hovered-div hide" :id="'hovered'+index">
                                 <div class="job_flex" style="gap: 10px; justify-content: flex-start;">
                                <div class="hover-image">
                                    <img :src="bid.influencerObj.image" class="hover-img-fluid" alt="$bid->influencer->last_name">
                                </div>

                                <p class="hover-name">
                                    {{bid.influencerObj.first_name+ ' '+ bid.influencerObj.last_name}}
                                </p>
                                </div>

                                 <div class="video_div my-3"  v-if="bid.image !== null">
                                <video controls id="video-creative"
                                style="width: 100%; height: 200px;object-fit: cover;" poster="/video-pre.png" >
                                <source :src="bid.video" type="video/mp4"/>
                                </video>
                                </div>

                                <div class="hover-skills">
                                    {{ bid.influencerObj.skills? bid.influencerObj.skills : 'No Skills For Creative'}}
                                </div>

                                <div class="job_flex">
                                    <p class="job-section"> <i class="fa fa-tasks"></i>Jobs: <span>{{ bid.jobCount }}</span></p>

                                    <p class="job-section">
                                        <i class="fa fa-tasks"></i>
                                        Rating:
                                        <span class="text-sm">
                                            <i class="fa fa-star star-fonts text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star star-fonts" :class="bid.influencer_rating >= 2? 'text-warning' : ''" aria-hidden="true"></i>
                                            <i class="fa fa-star star-fonts" :class="bid.influencer_rating >= 3? 'text-warning' : ''" aria-hidden="true"></i>
                                            <i class="fa fa-star star-fonts" :class="bid.influencer_rating >= 4? 'text-warning' : ''" aria-hidden="true"></i>
                                            <i class="fa fa-star star-fonts" :class="bid.influencer_rating >= 4.5? 'text-warning' : ''" aria-hidden="true"></i>
                                        </span>
                                    </p>
                                </div>
                                 <div class="job_flex">
                                <p class="job-section"> <i class="fa fa-flag"></i>Country: <span>{{ bid.country }}</span></p>

                                <p class="job-section"> <i class="fa fa-flag"></i>City: <span>{{ bid.influencerObj.city }}</span></p>
                                </div>

                                 <div class="job_flex">
                                <p class="job-section"> <i class="fa fa-briefcase"></i>Portfolio URL: <span><a :href="'/influencer/profile/' + bid.influencer_id">portfolio</a></span></p>
                                <p class="job-section"> <i class="fa fa-briefcase"></i>No of IG followers: <span>{{ bid.instagram_count }}</span></p>
                                </div>

                            </div>
                        </div>
                        <div class="ml-3">
                            <h6 class="font-weight-normal text-md mb-0">
                                {{bid.influencerObj.first_name}}
                            </h6>
                            <span class="text-sm">
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star" :class="bid.influencer_rating >= 2? 'text-warning' : ''" aria-hidden="true"></i>
                                <i class="fa fa-star" :class="bid.influencer_rating >= 3? 'text-warning' : ''" aria-hidden="true"></i>
                                <i class="fa fa-star" :class="bid.influencer_rating >= 4? 'text-warning' : ''" aria-hidden="true"></i>
                                <i class="fa fa-star" :class="bid.influencer_rating >= 4.5? 'text-warning' : ''" aria-hidden="true"></i>
                            </span>
                            <p class="proposal pt-2 mb-1" v-if="!bidJob.isAwarded || bidJob.isAwarded && bidJob.bid_id == bid.id">
                                {{bid.proposal}}
                            </p>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mb-0">
                            {{bidJob.currencySymbol}} {{bid.amount}}
                        </h6>
                        <span class="text-muted text-sm d-block">
                            in <span>{{bid.duration}}</span> Days
                        </span>
                         <button class="btn btn-sm btn-outline-danger"  v-if="bidJob.isAwarded == 0 && userProp == bid.influencer_id" @click="callfunc" style="border-radius: 10px;padding: 10px;font-size: 10px;margin-top: 10px;">Remove Bid</button>
                    </div>
                </div>


                <div class="card-body p-0">
                    {{  roleProp }}
                    <div class="jbDetailsSection ml-2 pl-5">
                        <div class="d-sm-block d-lg-flex justify-content-end">

                            <a class="chat-message-vendor" data-chatreceiver=""  v-if="(userProp == bidVendor.id && !bidJob.isAwarded) || (userProp == bidVendor.id && bidJob.isAwarded && bidJob.bid_id == bid.id)">
                                <chatBtn :bid-prop="bid.id" :user-prop="userProp"></chatBtn>
                            </a>

                            <a href="javascript:void(0);" data-bs-target="#payCreative" data-bs-toggle="modal" v-if="bidJob.amtDue && userProp==bidVendor.id && bidJob.bid_id == bid.id">
                                <button class="btn btn-success btn-block mt-2">Pay Milestone {{bidJob.currencySymbol}} {{bidJob.amtDue}}</button>
                            </a>

                            <form class="mb-0" id="awardForm" action="/jobs/bid/award" method="POST" v-if="!bidJob.isAwarded && userProp==bidVendor.id">
                                <input type="hidden" name="influencer_id" :value="bid.influencer_id">
                                <input type="hidden" name="job_id" :value="bidJob.id">
                                <input type="hidden" name="bid_id" :value="bid.id">
                                <input type="hidden" name="_token" :value="csrf">
                                <input type="hidden" name="bid_amount" :value="bid.amount">
                                <button type="submit" class="btn btn-success ml-sm-0 ml-lg-2 mt-2 pl-4 pr-4">Award</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>



        </div>

    </div>

    <h6 class="mt-4 text-center font-weight-normal" v-else>No Bid at the moment</h6>

</div>



</template>

<script>
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';
import chatBtn from './chatButton.vue';

export default {
    data() {
        return {
            bids:[],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),


        }
    },
    components:{
        chatBtn
    },
    props: ['jobProp', 'userProp', 'roleProp'],
    computed: {
        ...mapGetters([
        "allBids",
        "bidJob",
        "bidVendor"

        ]),
    },
     watch: {
        // whenever question changes, this function will run
        allBids() {
            this.connect();
        }
    },
    methods: {
        ...mapActions(['getJobBids']),

        connect(){
            window.Echo.private("new-notification")
          .listen('NewNotification', (e) =>{
              console.log('bid side');
              if(e.notification.type == 'bid'){
                this.getJobBids({job:this.jobProp, user:this.userProp});
              }
          })
        },

        bidHovered(index){
            $('#hovered'+index).removeClass('hide');
        },

        bidLeft(){
            $('.hovered-div').addClass('hide');
        },
        callfunc() {
      // Call your vanilla JavaScript function here
        delete_bid();
        },

    },
    mounted() {
        this.getJobBids({job:this.jobProp, user:this.userProp});
        this.connect();

        $('.chat-message').on('click', function(){
            // do ajax to get messages and populate message div
            $('#individual-chat').fadeIn('fast');
            var pos = $('.individual-chat-history').offset().top + 10000000;
            $('#individual-chat, .individual-chat-history').animate({ scrollTop:pos }, 1000);
        })
    }
}
</script>

<style scoped>

.bdImage{
    position:relative;
}
.hovered-div{
    min-height: 200px;
    border: 1px solid #d0d7de;
    padding: 1rem 2rem;
    left: 35px;
    top: 55px;
    position: absolute;
    width: 271.52px;
    background: #FDFDFD;
    box-shadow: 0px 6px 9px rgba(0, 0, 0, 0.14);
    border-radius: 20px;
    z-index:5;
}

.hover-img-fluid{
    height: 40px;
    width: 40px;
    border-radius: 50%;
}

.hover-name, .hover-skills{
    font-size: 15px;
    color: rgb(67, 62, 55);
    margin-bottom: 0;
}

.hover-skills{
    margin:10px 0;
}

.job_flex{
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.job-section{
    font-size:12px;
    color:#000000;
    font-weight: 700;
    /* margin: 0 !important; */
    margin-right: 1rem;
    margin-top: 0;
    margin-bottom: 0;
}

.job-section>i{
    font-size:13px !important;
    margin-right:2px;
}

.job-section>span{
    color:#000;
}

.star-fonts{
    font-size:13px !important;
}

@media (min-width: 544px){
    .hovered-div{
        width: 400px;
    }
}

</style>
