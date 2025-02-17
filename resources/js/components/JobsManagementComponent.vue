<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Jobs Table</h3>
      <form @submit.prevent="searchJob()">
        <div class="card-tools float-right">
          <div class="input-group">
            <input
              type="text"
              class="form-control"
              name="search_keyword"
              v-model="search_keyword"
              placeholder="Search....."
              aria-label="Search"
              aria-describedby="basic-addon2"
            />
            <div class="input-group-append">
              <button
                class="btn btn-outline-secondary"
                type="submit"
                @click="searchJob"
              >
                <i class="fas fa-search"></i>
              </button>
              <!-- <button
              class="btn btn-outline-secondary"
              data-toggle="modal"
              data-target="#addNew"
              @click="openModalWindow"
            >
              Add New <i class="fas fa-jobs-plus fa-fw"></i>
            </button> -->
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover table-striped">
        <tbody>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Budget</th>
            <th>Vendor Station</th>
            <th>Is Approved</th>
            <th>Is Awarded</th>
            <th>Unique ID</th>
            <th>Registered At</th>
            <th>Modify</th>
          </tr>
          <tr v-for="job in jobs.data" :key="job.id">
            <td>{{ job.id }}</td>
            <td>
              {{ job.name }}
            </td>
            <td>{{ job.description }}</td>
            <td>{{ job.budget.name }}</td>
            <td>{{ job.vendor.vendor_station }}</td>
            <td>
              {{
                job.isApproved == 1
                  ? "Yes"
                  : job.isApproved == 2
                  ? "Flagged"
                  : "No"
              }}
            </td>
            <td>
              {{ job.isAwarded ? "Yes" : "No" }}
            </td>
            <td>
              {{ job.unique_id }}
            </td>
            <td>{{ job.created_at | formatDate }}</td>

            <td>
              <div class="btn-group">
                <button
                  class="btn btn-success btn-sm"
                  data-id="jobs.id"
                  @click="editModalWindow(job)"
                >
                  Edit <i class="fa fa-edit blue"></i>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteJob(job.id)"
                >
                  Delete <i class="fa fa-trash red"></i>
                </button>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <pagination
                :data="jobs"
                @pagination-change-page="getResults"
              ></pagination>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
      data-backdrop="false"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editMode" class="modal-title" id="addNewLabel">
              Add New Job
            </h5>
            <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              Update Job
            </h5>

            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="closeModalWindow()"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <form @submit.prevent="editMode ? updateJob() : createJob()">
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12" v-if="loadingFetchJobDetails">
                    <p>Loading....</p>
                  </div>
                  <div class="col-md-12" v-if="!loadingFetchJobDetails">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <th>Item</th>
                          <th>Value</th>
                          <th>More Info</th>
                        </tr>
                        <tr v-if="job.budget">
                          <td>
                            <p>Budget</p>
                          </td>
                          <td>
                            <p>
                              <span v-html="job.budget.name"></span>
                            </p>
                          </td>
                          <td>
                            <p>
                              <span v-html="job.budget.min"></span>
                              -
                              <span v-html="job.budget.max"></span>
                            </p>
                          </td>
                        </tr>
                        <tr v-if="job.vendor">
                          <td>
                            <p>Vendor</p>
                          </td>
                          <td>
                            <p>
                              Vendor Station:
                              <span v-html="job.vendor.vendor_station"></span>
                            </p>
                          </td>
                          <td>
                            <p>
                              Location:
                              <span v-html="job.vendor.location"> </span>
                            </p>
                          </td>
                        </tr>
                        <tr v-if="job.currency">
                          <td>
                            <p>Currency</p>
                          </td>
                          <td>
                            <p>
                              <span v-html="job.currency.symbol"></span>
                            </p>
                          </td>
                          <td>
                            <p>
                              <span v-html="job.currency.name"></span>
                            </p>
                          </td>
                        </tr>
                        <tr v-if="job.influencer">
                          <td>
                            <p>Creative</p>
                          </td>
                          <td>
                            <p>
                              <span v-html="job.influencer.first_name"></span>
                              <span v-html="job.influencer.last_name"></span>
                            </p>
                          </td>
                          <td>
                            <p>
                              <span v-html="job.influencer.phone_number"></span>
                              <span v-html="job.influencer.email"></span>
                            </p>
                          </td>
                        </tr>
                        <tr v-if="job.bids">
                          <td>
                            <p>Bids</p>
                          </td>
                          <td>
                            <p>
                              <span v-html="job.bids.length"></span>
                            </p>
                          </td>
                          <td>
                            <p>-</p>
                          </td>
                        </tr>
                        <tr v-if="job.vendor">
                          <td>
                            <p>Vendor Rating</p>
                          </td>
                          <td>
                            <p>
                              <span v-html="job.vendor.rating"></span>
                            </p>
                          </td>
                          <td>
                            <p>-</p>
                          </td>
                        </tr>
                        <tr v-if="job.product">
                          <td>
                            <p>Product</p>
                          </td>
                          <td>
                            <p>
                              <span v-html="job.product.name"></span>
                            </p>
                          </td>
                          <td>
                            <p>
                              <span v-html="job.product.description"> </span>
                            </p>
                          </td>
                        </tr>
                        <tr v-if="job">
                          <td>
                            <p>Job Awarded</p>
                          </td>
                          <td>
                            <p>-</p>
                          </td>
                          <td>
                            <p>
                              {{ form.isAwarded ? "Yes" : "No" }}
                            </p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <label for="isApproved1">Approval status:</label><br />
                    <div class="form-check form-check-inline">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="inlineRadioOptions"
                        v-model="form.isApproved"
                        id="inlineRadio1"
                        value="0"
                      />
                      <label class="form-check-label" for="inlineRadio1"
                        >Pending</label
                      >
                    </div>
                    <div class="form-check form-check-inline">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="inlineRadioOptions"
                        v-model="form.isApproved"
                        id="inlineRadio2"
                        value="1"
                      />
                      <label class="form-check-label" for="inlineRadio2"
                        >Approved</label
                      >
                    </div>
                    <div class="form-check form-check-inline">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="inlineRadioOptions"
                        v-model="form.isApproved"
                        id="inlineRadio3"
                        value="2"
                      />
                      <label class="form-check-label" for="inlineRadio3"
                        >Flagged (as inappropriate)</label
                      >
                    </div>
                    <!-- <div class="form-group">
                      <label for="isApproved1">Approval status:</label><br />
                      <input
                        type="checkbox"
                        id="isApproved"
                        name="isApproved"
                        v-model="form.isApproved"
                        :class="{
                          'is-invalid': form.errors.has('isApproved'),
                        }"
                      />
                      <label for="isApproved">{{ "Approve job" }}</label>
                      <div
                        v-if="form.errors.has('isApproved')"
                        v-html="form.errors.get('isApproved')"
                      />
                    </div> -->
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Name:</label>
                      <input
                        v-model="form.name"
                        type="text"
                        name="name"
                        maxlength="50"
                        placeholder="Name"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('name'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('name')"
                        v-html="form.errors.get('name')"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description">Job description:</label>
                      <textarea
                        v-model="form.description"
                        id="description"
                        name="description"
                        placeholder="Job description..."
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('description'),
                        }"
                        rows="3"
                        max-rows="6"
                      ></textarea>

                      <div
                        v-if="form.errors.has('description')"
                        v-html="form.errors.get('description')"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-danger"
                data-dismiss="modal"
                @click="closeModalWindow()"
                :disabled="loadingCreateJob || loadingUpdateJob"
              >
                Close
              </button>
              <button
                v-show="editMode"
                type="submit"
                class="btn btn-primary"
                :disabled="loadingCreateJob"
              >
                <span v-show="!loadingUpdateJob"> Update </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingUpdateJob"
                  class="spinner-border spinner-border-sm"
                  role="status"
                >
                  <span class="sr-only">Loading...</span>
                </div>
              </button>
              <button
                v-show="!editMode"
                type="submit"
                class="btn btn-primary"
                :disabled="loadingCreateJob"
              >
                <span v-show="!loadingCreateJob"> Create </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingCreateJob"
                  class="spinner-border spinner-border-sm"
                  role="status"
                >
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
      jobs: {},
      job: {},
      countries: {},
      search_keyword: "",
      roles: {},
      loadingCreateJob: false,
      loadingUpdateJob: false,
      loadingRoes: false,
      roleErrors: null,
      loadingFetchJobDetails: false,
      fetchJobDetailsErrors: null,
      form: new Form({
        id: "",
        name: "",
        description: "",
        isAwarded: false,
        isApproved: false,
      }),
    };
  },
  methods: {
    editModalWindow(job) {
      this.loadingFetchJobDetails = true;
      this.form.clear();
      this.editMode = true;
      this.form.reset();
      this.form.fill(job);
      $("#addNew").modal("show");
      axios
        .get("api/v1/jobs/" + this.form.id)
        .then((data) => {
          this.loadingFetchJobDetails = false;
          this.job = data.data;
          console.log(data.data);
        })
        .catch(() => {
          console.log("Error......");
          this.loadingFetchJobDetails = false;
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "<a href>Why do I have this issue?</a>",
          });
        });
    },
    updateJob() {
      this.loadingUpdateJob = true;
      this.form
        .put("api/v1/jobs/" + this.form.id)
        .then((res) => {
          this.loadingUpdateJob = false;
          Toast.fire({
            icon: "success",
            title: "Job updated successfully",
          });

          Fire.$emit("AfterCreatedJobLoadIt");

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingUpdateJob = false;
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "<a href>Why do I have this issue?</a>",
          });
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
    loadJobs() {
      this.$Progress.start();
      axios
        .get("api/v1/jobs")
        .then((data) => {
          this.jobs = data.data;
          this.$Progress.finish();
        })
        .catch(() => {
          console.log("Error......");
          this.$Progress.finish();
        });

      //pick data from controller and push it into jobs object
    },
    getResults(page = 1) {
      axios
        .get("api/v1/jobs?page=" + page)
        .then((data) => {
          this.jobs = data.data;
        })
        .catch(() => {
          console.log("Error......");
        });
    },

    searchJob() {
      this.$Progress.start();
      this.search_keyword.length === 0
        ? this.loadJobs()
        : axios
            .get("api/v1/jobs/filter/" + this.search_keyword)
            .then((data) => {
              this.jobs = data.data;
              this.$Progress.finish();
            })
            .catch(() => {
              console.log("Error......");
              this.$Progress.finish();
            });

      //pick data from controller and push it into jobs object
    },
    loadCountries() {
      this.$Progress.start();
      axios
        .get("api/v1/countries")
        .then((data) => {
          this.countries = data.data;
          this.$Progress.finish();
        })
        .catch(() => {
          console.log("Error......");
          this.$Progress.finish();
        });

      //pick data from controller and push it into jobs object
    },
    loadRoles() {
      this.loadingRoes = true;
      axios
        .get("api/v1/roles")
        .then((data) => {
          this.roles = data.data;
          this.loadingRoes = false;
        })
        .catch(() => {
          console.log("Error......");
          this.loadingRoes = false;
        });

      //pick data from controller and push it into jobs object
    },

    createJob() {
      this.loadingCreateJob = true;
      this.form
        .post("api/v1/jobs")
        .then((res) => {
          this.loadingCreateJob = false;
          Fire.$emit("AfterCreatedJobLoadIt"); //custom events

          Toast.fire({
            icon: "success",
            title: "Job created successfully",
          });

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingCreateJob = false;
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: "<a href>Why do I have this issue?</a>",
          });
        });

      //this.loadJobs();
    },
    deleteJob(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          //Send Request to server
          this.form
            .delete("api/v1/jobs/" + id)
            .then((response) => {
              Swal.fire("Deleted!", "Job deleted successfully", "success");
              this.loadJobs();
            })
            .catch(() => {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: "<a href>Why do I have this issue?</a>",
              });
            });
        }
      });
    },
  },

  created() {
    this.loadJobs();
    this.loadCountries();
    this.loadRoles();
    Fire.$on("AfterCreatedJobLoadIt", () => {
      //custom events fire on
      this.loadJobs();
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
