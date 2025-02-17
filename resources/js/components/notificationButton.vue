<template>
        <a href="javascript:void(0);" class="nav-link uSREICON tobe-notification-bell" id="tobe-notification-bell" @click="markNotificationAsRead()">
            <i class="fa fa-bell"></i>
            <span id="vicomma-notification" class="badge badge-warning navbar-badge" v-if="this.notiCount>0">{{notiCount}}</span>
        </a>

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
                "userNotifications", "notiCount"

            ]),
        },
        props: ['userProp'],
        methods: {
            ...mapActions(["markNotification", "getUserNotifications"]),
            markNotificationAsRead(){
                this.markNotification(this.userProp);
                this.getUserNotifications(this.userProp);

            }

        },
        created() {
        },
        mounted() {

        }
    }
</script>

<style>

</style>
