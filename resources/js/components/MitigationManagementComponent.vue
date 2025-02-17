<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mitigations Table</h3>
            <!-- <form @submit.prevent="searchCategory()">
                <div class="card-tools float-right">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_keyword" v-model="search_keyword"
                            placeholder="Search....." aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" @click="searchCategory">
                                <i class="fas fa-search"></i>
                            </button>

                        </div>
                    </div>
                </div>
            </form> -->
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-striped">
                <tbody>
                    <tr>
                        <th>Title</th>
                        <th>Payment Ref</th>
                        <th>Created At</th>
                        <th>Mitigation Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                    <tr v-for="category in mitigations" :key="category.id">
                        <td>
                            {{ category.title }}
                        </td>
                        <td>
                            {{ category.payment_ref }}
                        </td>
                        <td>{{ category.created_at | formatDate }}</td>
                        <td>
                            {{ category.mitigation_amount }}
                        </td>
                        <td>
                            {{ category.status }}
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-success btn-sm" data-id="categories.id" @click="viewJob(category)">
                                    Job <i class="fa fa-eye blue"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" @click="viewDispute(category)">
                                    Dispute <i class="fa fa-eye red"></i>
                                </button>

                                <button class="btn btn-success btn-sm" data-id="categories.id"
                                    @click="editModalWindow(category)">
                                    Decision <i class="fa fa-edit blue"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <pagination :data="mitigations" @pagination-change-page="getResults"></pagination>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true"
            data-backdrop="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">
                            Enter Your Mitigation Response
                        </h5>


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="closeModalWindow()">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form @submit.prevent="submitMitigation()">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Decision:</label>
                                            <input v-model="form.decision" type="text" name="decision"
                                                placeholder="Enter the decision" class="form-control" :class="{
                                                    'is-invalid': form.errors.has('decision'),
                                                }" />
                                            <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Reason:</label>
                                            <textarea v-model="form.reason" type="text" name="reason"
                                                placeholder="Enter reason for decision" class="form-control" :class="{
                                                    'is-invalid': form.errors.has('reason'),
                                                }">
                              </textarea>

                                            <div v-if="form.errors.has('reason')" v-html="form.errors.get('reason')" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Settlement Amount ($):</label>
                                            <input v-model="form.amount" type="number" name="decision"
                                                placeholder="Settlement Amount" class="form-control" :class="{
                                                    'is-invalid': form.errors.has('amount'),
                                                }" />
                                            <div v-if="form.errors.has('name')" v-html="form.errors.get('amount')" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="to_pay">To pay:</label>
                                            <select name="to_pay" v-model="form.to_pay" id="to_pay"
                                                class="form-control" :class="{
                                                    'is-invalid': form.errors.has('to_pay'),
                                                }">
                                                <option value="vendor">
                                                    Vendor
                                                </option>

                                                <option value="creative">
                                                    Creative
                                                </option>
                                            </select>
                                            <div v-if="form.errors.has('to_pay')"
                                                v-html="form.errors.get('to_pay')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeModalWindow()"
                                :disabled="loadingCreateCategory || loadingUpdateCategory">
                                Close
                            </button>
                            <button v-show="editMode" type="submit" class="btn btn-primary"
                                :disabled="loadingCreateCategory">
                                <span v-show="!loadingUpdateCategory"> Submit </span>
                                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                                <div v-show="loadingUpdateCategory" class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            editMode: false,
            mitigations: [],
            search_keyword: "",
            residulepayments: {},
            loadingCreateCategory: false,
            loadingUpdateCategory: false,
            loadingResidulePayment: false,
            roleErrors: null,
            form: new Form({
                decision: "",
                reason: "",
                to_pay: 'vendor',
                amount: 0,
                mitigation_id:null,
            }),
            activeMitigation: {},

        };
    },
    methods: {
        editModalWindow(mitigation) {
            this.activeMitigation = mitigation;
            this.form.clear();
            this.editMode = true;
            this.form.reset();
            $("#addNew").modal("show");
        },
        submitMitigation() {
            this.form.mitigation_id = this.activeMitigation.id
            if (!this.form.decision || !this.form.reason || !this.form.amount) {
                Toast.fire({
                    icon: "error",
                    title: "All form fields are required",
                });
                return;
            }

            // console.log(this.form.decision);
            this.loadingUpdateCategory = true;
            this.form
                .put(`mitigation/close`)
                .then((res) => {

                    if(res.status == 200){
                        this.loadingUpdateCategory = false;
                        this.loadMitigations();
                        Toast.fire({
                            icon: "success",
                            title: "Mitigation updated successfully",
                        });

                        $("#addNew").modal("hide");
                        this.loadingUpdateCategory = false;
                    }



                })
                .catch(() => {
                    this.loadingUpdateCategory = false;
                    console.log("Error.....");
                });
        },
        openModalWindow() {
            this.editMode = false;
            this.form.reset();
            $("#addNew").modal("show");
        },
        closeModalWindow() {
            this.form.clear();
            this.form.reset();
            $("#addNew").modal("hide");
        },
        loadMitigations() {
            this.$Progress.start();
            axios
                .get("mitigations/getAll")
                .then((res) => {
                    this.mitigations = res.data;

                    console.log(res)
                    this.$Progress.finish();
                })
                .catch(() => {
                    console.log("Error......");
                    this.$Progress.finish();
                });

            //pick data from controller and push it into categories object
        },
        viewJob(mitigation) {
            axios
                .get(`mitigation/viewJob/${mitigation.id}`)
                .then((response) => {
                    //   console.log(response);

                    window.open(response.data, '_blank');
                })
                .catch(() => {
                    console.log("Error......");
                });
        },
        viewDispute(mitigation) {
            axios
                .get(`mitigation/viewDispute/${mitigation.id}`)
                .then((response) => {
                    //   console.log(response);

                    window.open(response.data, '_blank');
                })
                .catch(() => {
                    console.log("Error......");
                });
        },
        getResults(page = 1) {
            axios
                .get(`mitigation/viewDispute/${mitigation.id}/?page=${page}`)
                .then((data) => {
                    this.mitigations = data.data;
                })
                .catch(() => {
                    console.log("Error......");
                });
        },

        // searchCategory() {
        //     this.search_keyword.length === 0
        //         ? this.loadMitigations()
        //         : axios
        //             .get("api/v1/categories/filter/" + this.search_keyword)
        //             .then((data) => {
        //                 this.categories = data.data;
        //             })
        //             .catch(() => {
        //                 console.log("Error......");
        //             });

        //     //pick data from controller and push it into categories object
        // },

    },

    created() {
        this.loadMitigations();
        this.loadResidulePayment();
        Fire.$on("AfterCreatedCategoryLoadIt", () => {
            //custom events fire on
            this.loadMitigations();
        });
    },
};
</script>
<style scoped>
.modal-content,
.card {
    -webkit-border-radius: 0px !important;
    -moz-border-radius: 0px !important;
    border-radius: 0px !important;
}
</style>
