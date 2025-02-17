<template>
    <div class="dispute-card">

        <img src="/images/disp.svg" alt="">
        <div class="dispute-stages">

            <p>
                STAGE 1:
                "What is the issue?"
            </p>

            <p>
                STAGE 2:
                "Discuss & Compromise"
            </p>

            <p>
                STAGE 3:
                "Pay & Resolve"
            </p>

            <p>
                STAGE 4:
                "Conclusion"
            </p>

        </div>

    </div>
</template>

<script>
// import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';

export default {
    data() {
        return {

        }
    },
    components:{

    },
    props: ['jobProp', 'userProp', 'roleProp'],
    computed: {
        ...mapGetters([


        ]),
    },
    watch: {

    },
    methods: {
        ...mapActions(['getJobBids']),

    },
    mounted() {

    }
}
</script>

<style scoped>

    div{
        font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }

    .dispute-card{
        display: block;
        -webkit-text-decoration: none;
        text-decoration: none;
        color: #000;
        background-color: #fff;
        box-sizing: border-box;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgb(0 0 0 / 5%), rgb(0 0 0 / 5%) 0px 28px 23px -7px, rgb(0 0 0 / 4%) 0px 12px 12px -7px;
        padding: 16px;
        width:100%;
        min-height:200px;
    }

    .dispute-card>img{
        width: inherit;
        vertical-align: middle;
        border-style: none;
        overflow-clip-margin: content-box;
        overflow: clip;
    }

    .dispute-stages{
        display: flex;
        justify-content: space-around;
    }

    .dispute-stages>p{
        text-align: center;

    }

</style>
