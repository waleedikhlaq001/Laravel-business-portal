<template>
 <div>

    <div>
        <p class="title">
            Stage 1: <span>Initiate Dispute</span>
        </p>

        <p class="desc">
            Do you have an issue related to the job delivery and payments? file a complaint now.
        </p>
    </div>
    <disputeCard></disputeCard>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Start Dispute Process
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Stage 1: What is the Issue?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input">
                    <label for="">So, what is wrong?</label>
                    <textarea name="" id="" cols="15" rows="3" placeholder="Please describe in details what is wrong" v-model="message"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary">Agree and Pay</button>
                <button type="button" class="btn btn-secondary" @click="createDispute()">Continue Dispute</button>

            </div>
            </div>
        </div>
    </div>
 </div>


</template>

<script>
// import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';
import disputeCard from './disputeCard.vue';

export default {
    data() {
        return {

            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            message:'',
            job_id : null,


        }
    },
    components:{
        disputeCard
    },
    props: ['jobProp'],
    computed: {
        ...mapGetters([


        ]),
    },
        watch: {
        // whenever question changes, this function will run
        allBids() {
            this.connect();
        }
    },
    methods: {
        ...mapActions(['submitDispute']),

        createDispute(){

            if (this.message == "") {
                alert('Enter Dispute Details')
                return;
            }

            this.submitDispute({
                message: this.message,
                job_id: this.jobProp,
            }).then((sent)=>{
                alert("Dispute process started successfully");
                this.message = "";
                location.reload();
            });


        }

    },
    mounted() {

    }
}
</script>

<style scoped>

    div{
        font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }

    .title, .modal-title{
        font-size: 1.5rem;
        line-height: 1em;
        margin: 0;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.2;
        color: #6f3c96;
    }

    .title>span{
        color:black;
    }

    .desc{
        font-size: 16px;
        color: #000;
        line-height: 28px;
        font-family: inherit;
    }

    .btn{
        margin-top: 20px;
    }

    div.input{
        display: flex;
        flex-direction: column;
    }

    div.input>textarea{
        border-color: rgb(185, 185, 185);
    }
    div.input>textarea:focus{
        border-color: rgb(54, 165, 238);
    }

</style>
