/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

//Import Vue Filter
require("./filter");

//Import progressbar
require("./progressbar");

//Setup custom events
require("./customEvents");

$(function () {
    $('[data-toggle="popover"]').popover()
})


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Import Sweetalert2
import Swal from "sweetalert2";
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});
window.Toast = Toast;

//Import v-from
import Form from "vform";
import Vue from "vue";
window.Form = Form;

//import store
import store from './store/index.js';

//Pagination laravel-vue-pagination
Vue.component("pagination", require("laravel-vue-pagination"));
//using my store
Vue.use(store);

let Fire = new Vue();
window.Fire = Fire;

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component(
    "user-description",
    require("./components/Description.vue").default
);
Vue.component("jobs-list", require("./components/JobsComponent.vue").default);
Vue.component("subaccount", require("./components/Subaccount.vue").default);
Vue.component("jobvideo", require("./components/UploadVideo.vue").default);
Vue.component("showvideo", require("./components/ShowVideo.vue").default);


// chat files
Vue.component("chat", require("./components/ChatComponent.vue").default);
Vue.component("message", require("./components/Message.vue").default);
Vue.component("chat-btn", require("./components/chatButton.vue").default);


//notification files
Vue.component("notification-icon", require("./components/notificationButton.vue").default);
Vue.component("noti-alert", require("./components/notiAlert.vue").default);
Vue.component("notifications", require("./components/notifications.vue").default);

//bid files
Vue.component("all-bids", require("./components/bids.vue").default);

//dispute files
Vue.component("start-dispute", require("./components/dispute/start.vue").default);
Vue.component("stage-two", require("./components/dispute/stage_two.vue").default);


Vue.component(
    "update-phone-number",
    require("./components/UpdatePhoneNumber.vue").default
);

Vue.component(
    "users-management-component",
    require("./components/UsersManagementComponent.vue").default
);
Vue.component(
    "jobs-management-component",
    require("./components/JobsManagementComponent.vue").default
);
Vue.component(
    "categories-management-component",
    require("./components/CategoriesManagementComponent.vue").default
);
Vue.component(
    "mitigation-management-component",
    require("./components/MitigationManagementComponent.vue").default
);
Vue.component(
    "products-management-component",
    require("./components/ProductsManagementComponent.vue").default
);
Vue.component(
    "skills-management-component",
    require("./components/SkillsManagementComponent.vue").default
);
Vue.component(
    "residules-management-component",
    require("./components/ResidulesManagementComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    store:store
});

