<template>

    <div class="dropdown-chat-menu dropdown-menu-lg shadow-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown" id="tobe-notifications">
        <div class="noti-header">
            <div class="row align-items-center header-row">
                <div class="col-6">
                    <h5 class="m-0 font-size-10" style="color: rebeccapurple;"> Notifications </h5>
                </div>
                <div class="col-6 text-right">
                    <a href="#!" class="small" style="color: gray;font-size: 10px;font-weight: 500;"> Mark All</a>
                </div>
            </div>
        </div>
        <div data-simplebar style="max-height: 300px; overflow:auto;" class="fine-scrollbar">


            <a href="javascript:void(0);" class="notification-item" v-if="userNotifications">
                <div class="d-flex align-items-start" v-for="(noti, index) in userNotifications" :key="index">
                    <div class="flex-shrink-0 me-3">
                        <div v-if="!noti.senderObject.image" class="avatar-xs">
                            <img src="https://via.placeholder.com/50" class="rounded-circle avatar-xs" alt="alt-pic">
                        </div>

                        <div v-else class="avatar-xs">
                            <img :src="noti.senderObject.image" class="rounded-circle avatar-xs" alt="user-pic">
                        </div>

                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1 noti-type" v-if="noti.type == 'chat'">You have a new message</h6>
                        <h6 class="mb-1 noti-type" v-else-if="noti.type == 'job'">New Job Posted</h6>
                        <h6 class="mb-1 noti-type" v-else-if="noti.type == 'award'">Job Awarded To You</h6>
                        <h6 class="mb-1 noti-type" v-else-if="noti.type == 'bid'">New Bid</h6>
                        <h6 class="mb-1 noti-type" v-else-if="noti.type == 'Wallet'">Wallet Transaction</h6>
                        <h6 class="mb-1 noti-type" v-else-if="noti.type == 'videoUpload'">Video Uploaded For Your Job</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1 float-left" style="font-weight: 600;">{{noti.message}}</p>
                            <p class="mb-0 text-right float-right" style="font-size:9px;"><i class="mdi mdi-clock-outline"></i> {{noti.date}}</p>
                        </div>
                    </div>
                </div>
            </a>


            <a href="javascript:void(0);" class="notification-item" v-else>
                <div class="d-flex align-items-start">
                    No New Notifications
                </div>
            </a>

        </div>
        <div class="p-1 border-top">
            <div class="d-grid">
                <a class="btn btn-sm btn-link font-size-14 text-center" style="font-size:12px;" href="javascript:void(0)">
                    <i class="uil-arrow-circle-right me-1"></i> View More..
                </a>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';

export default {
    data() {
        return {

        }
    },
    computed: {
        ...mapGetters([
            "userNotifications",

        ]),
    },
    props: ['userProp'],
    methods: {
        ...mapActions(["getUserNotifications"]),

    },
    mounted() {
        this.getUserNotifications(this.userProp);
    }
}
</script>

<style scoped>
.noti-header{
    border-bottom: 1px solid #80808014;
}
.header-row{
    padding: 15px;
}
.noti-type{
    font-weight: 400;
    color: #6da725;
}
.dropdown-chat-menu{
    position: absolute;
    top: 80px;
    right: 35px;
    z-index: 10;
    background: #ffffff;
    max-width: 390px;
    border-radius: 8px;
}

.dropdown-chat-menu::before{
    content: "";
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: 10px solid white;
    position: absolute;
    top: -10px;
    right: 41%;
}

.avatar-xs {
    height: 2rem;
    width: 2rem;
}


.notification-item .d-flex {
    padding: 0.75rem 1rem;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}
.notification-item .d-flex:hover {
    background-color: var(--bs-dropdown-link-hover-bg);
}

h6,p{
    font-size:12px;
      line-height: normal;
      color: #666363;
}






/* .dropdown-menu {
    box-shadow: 0 2px 4px rgba(15, 34, 58, 0.12);
    border: 1px solid var(--bs-border-color);
}
@media (min-width: 992px) {

    .topnav .dropdown .dropdown-menu .arrow-down::after {
        right: 15px;
        -webkit-transform: rotate(-135deg) translateY(-50%);
        transform: rotate(-135deg) translateY(-50%);
        position: absolute;
    }
    .topnav .dropdown .dropdown-menu .dropdown .dropdown-menu {
        position: absolute;
        top: 0 !important;
        left: 100%;
        display: none;
    }
    .topnav .dropdown:hover > .dropdown-menu {
        display: block;
    }
    .topnav .dropdown:hover > .dropdown-menu > .dropdown:hover > .dropdown-menu {
        display: block;
    }
    .navbar-toggle {
        display: none;
    }
}

@media (max-width: 991.98px) {
    body[data-layout="horizontal"] .navbar-brand-box .logo-dark {
        display: var(--bs-display-block);
    }
    body[data-layout="horizontal"] .navbar-brand-box .logo-dark span.logo-sm {
        display: var(--bs-display-block);
    }
    body[data-layout="horizontal"] .navbar-brand-box .logo-light {
        display: var(--bs-display-none);
    }
    .topnav {
        position: fixed;
        max-height: 360px;
        overflow-y: auto;
        padding: 0;
    }
    .topnav .navbar-nav .nav-link {
        padding: 0.75rem 1.1rem;
    }
    .topnav .dropdown .dropdown-menu {
        background-color: transparent;
        border: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding-left: 15px;
    }
    .topnav .dropdown .dropdown-menu.dropdown-mega-menu-xl {
        width: auto;
    }
    .topnav .dropdown .dropdown-menu.dropdown-mega-menu-xl .row {
        margin: 0;
    }
    .topnav .dropdown .dropdown-item {
        position: relative;
        background-color: transparent;
    }
    .topnav .dropdown .dropdown-item.active,
    .topnav .dropdown .dropdown-item:active {
        color: #5b73e8;
    }
    .topnav .arrow-down::after {
        right: 15px;
        position: absolute;
    }
}
@media (max-width: 991.98px) {
    .topnav-menu .navbar-nav li:last-of-type .dropdown .dropdown-menu {
        right: 100%;
        left: auto;
    }
}
@media (max-width: 600px) {
    .navbar-header .dropdown {
        position: static;
    }
    .navbar-header .dropdown .dropdown-menu {
        left: 10px !important;
        right: 10px !important;
    }
}
.table-rep-plugin .btn-group.pull-right .dropdown-menu {
    right: 0;
    -webkit-transform: none !important;
    transform: none !important;
    top: 100% !important;
}

.user-chat-nav .dropdown .dropdown-menu {
    -webkit-box-shadow: 0 2px 4px rgba(15, 34, 58, 0.12);
    box-shadow: 0 2px 4px rgba(15, 34, 58, 0.12);
    border: 1px solid var(--bs-border-color);
} */



</style>
