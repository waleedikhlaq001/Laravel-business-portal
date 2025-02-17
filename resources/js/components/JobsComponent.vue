<template>
  <div class="container">
    <div class="jbContainer shadow-sm bg-white w-100">
      <div class="row g-3">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="card jbCardContainer shadow-sm bg-white p-2">
            <div class="card-header pt-0 pl-0">
              <form @submit.prevent="filterJobs()">
                <div class="row">
                  <div class="col-md-7">
                    <div
                      class="input-group ig-border ml-1"
                      style="border-radius: 100px"
                    >
                      <input
                        type="text"
                        class="form-control rounded-corners"
                        name="search_keyword"
                        v-model="search_keyword"
                        placeholder="job keyword....."
                        aria-label="Search"
                        aria-describedby="basic-addon2"
                      />
                      <span
                        class="input-group-text bg-transparent"
                        style="border: 0"
                      >
                        <!-- <i class="fa fa-search" aria-hidden="true"></i> -->
                      </span>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="d-flex justify-content-end">
                      <button
                        type="submit"
                        class="btn btn-sm"
                        @click="filterJobs()"
                      >
                        <i class="fas fa-search fa-fw"></i> Search
                      </button>
                      <button class="btn btn-sm">|</button>
                      <button class="btn btn-sm" @click="clearSearch()">
                        <i class="fas fa-minus"></i> Clear
                      </button>
                      <button class="btn btn-sm">|</button>
                      <button
                        class="btn btn-sm"
                        data-toggle="modal"
                        data-target="#advancedFilter"
                        @click="openModalWindow"
                      >
                        <i class="fas fa-filter fa-fw"></i> Advanced Filter
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              <div style="width: 100%; display: flex; align-items: center; justify-content: flex-end">
               <button
                class="btn btn-outline-secondary btn-sm"
                type="submit"
                @click="getResults"
                style="margin-top: 10px;border-radius: 25px;margin-left: auto;"
              >
              <i class="fa fa-refresh" /> Refresh List
               </button>
               </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-lg-12">
          <div class="d-flex justify-content-center mt-4" v-if="loading">
            <div class="lds-ripple">
              <div></div>
              <div></div>
            </div>
          </div>
          <div class="mt-4" v-if="jobs.data == ''">
            <h6 class="text-center">No Jobs</h6>
          </div>
          <a
            :href="'/jobs/details/' + job.unique_id"
            class="jbAHREF"
            v-for="job in jobs.data"
            :key="job.id"
            style="color: #241033"
          >
            <div class="card-body border-bottom">
                <div class="job-owner shadow" v-if="job.vendor.user_id == auth">
                    <i class="fas fa-check text-white text-center" aria-hidden="true"></i>
                </div>
                <div class="row g-3">
                <div class="col-sm-12 col-md-12 col-lg-9">
                  <div class="jbDetailsSection">
                    <h5 class="text-snd">
                      {{ job.name }}
                      <!-- <span
                        class="text-danger mr-2"
                        v-if="!job.isApproved && vendor.id == job.vendor_id"
                      >
                        - (Pending approval, only you can see this!)
                      </span> -->
                    </h5>

                    <p>
                      {{ job.description.substring(0, 250) + "..." }}
                    </p>
                    <div class="row g-2">
                      <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="text-sm">
                          <i class="fas fa-clock" aria-hidden="true"></i>
                          <span class="text-danger mr-2" v-if="job.isAwarded"
                            >Awarded</span
                          >
                          <span class="text-success mr-2" v-else>Open</span>
                          {{ job.created_at | formatDate }} -
                          <span v-html="job.bids.length"></span> application(s)
                          <span v-for="bid in job.bids" :key="bid.id">
                              <span class="text-danger" v-if="bid.influencer_id == auth">&nbsp;&nbsp; (You placed a Bid)</span>
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="text-sm">
                          <i class="fa fa-user mr-2" aria-hidden="true"></i>
                          No Jobs Completed
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3">

                  <div class="d-flex" v-if="job.budget_id != null">
                    <h4 class="font-weight-normal text-md">
                      <span>
                        {{ job.currency.symbol
                        }}{{ job.budget.min | formatNumber }} -
                        {{ job.currency.symbol
                        }}{{ job.budget.max | formatNumber }}</span
                      >
                    </h4>
                  </div>
                </div>
              </div>
            </div>
          </a>
          <pagination
            :data="jobs"
            @pagination-change-page="getResults"
            class="mt-4"
          >
            <span slot="prev-nav">&lt; Previous</span>
            <span slot="next-nav">Next &gt;</span>
          </pagination>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="advancedFilter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="advancedFilterLabel"
      aria-hidden="true"
      data-backdrop="false"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="advancedFilterLabel">
              Advanced Filter
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

          <form @submit.prevent="advancedFilterJobs()">
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="d-flex g-3 h-100">
                      <!-- <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          id="inlineCheckbox1"
                          value="option1"
                        />
                        <label class="form-check-label" for="inlineCheckbox1"
                          >Fixed Payment</label
                        >
                      </div> -->
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          id="inlineCheckbox2"
                          v-model="form.residule_payment"
                        />
                        <label class="form-check-label" for="inlineCheckbox2"
                          >Payment Verified</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                      <label for="form-keyword">Keyword:</label>
                      <input
                        type="text"
                        id="form-keyword"
                        class="form-control"
                        name="search_keyword"
                        v-model="form.search_keyword"
                        placeholder=""
                        aria-label="Search"
                        aria-describedby="basic-addon2"
                      />
                    </div>
                  </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <label for="budget_id">Budget:</label>
                        <select
                          name="budget_id"
                          v-model="form.budget_id"
                          id="budget_id"
                          class="form-control"
                          :class="{
                            'is-invalid': form.errors.has('budget_id'),
                          }"
                        >
                          <option
                            v-for="(budget, index) in budgets.data"
                            v-bind:value="budget.id"
                            :key="index"
                          >
                            {{ budget.name }}
                          </option>
                        </select>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-outline-secondary btn-sm d-block d-md-inline-block mr-2"
                data-dismiss="modal"
                @click="closeModalWindow()"
                :disabled="loadingFiterJob"
              >
                Close
              </button>
              <button
                type="submit"
                class="btn btn-secondary btn-sm d-block d-md-inline-block mr-2"
                data-dismiss="modal"
                :disabled="loadingFiterJob"
                @click="advancedFilterJobs()"
              >
                <span v-show="!loadingFiterJob"> Apply </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingFiterJob"
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
var numeral = require("numeral");
var moment = require("moment");

Vue.filter("formatNumber", function (value) {
  return numeral(value).format("0,0"); // displaying other groupings/separators is possible, look at the docs
});
Vue.filter("formatDate", function (value) {
  if (value) {
    return moment(String(value)).format("MMM Do, h:mmA");
  }
});
export default {
  props: ['auth_id'],
  data() {
    return {
      loading: false,
      loadingFiterJob: false,
      jobs: {},
      form: new Form({
        search_keyword: "",
        category_id: null,
        budget_id: null,
        residule_payment: false,
      }),
      search_keyword: "",
      categories: {},
      budgets: {},
      auth: this.auth_id,
    };
  },
  mounted() {},
  methods: {
    clearSearch() {
      this.loading = false;
      this.getResults();
      this.search_keyword = "";
      this.form.clear();
      this.form.reset();
    },
    openModalWindow() {
      // this.editMode = false;
      // this.form.clear();
      // this.form.reset();
      $("#advancedFilter").modal("show");
    },
    closeModalWindow() {
      // this.form.clear();
      // this.form.reset();
      $("#advancedFilter").modal("hide");
    },
    getResults(page = 1) {
      this.loading = true;
      axios
        .get("/jobs-list?page=" + page)
        .then((response) => {
          //   console.log(response.data);
          this.jobs = response.data;
          this.loading = false;
        })
        .catch(function (error) {
          this.loading = false;
          console.log(error);
        });
    },
    loadBudgets() {
      axios
        .get("/jobs-budgets")
        .then((data) => {
          this.budgets = data.data;
        })
        .catch(() => {
          console.log("Error......");
        });
    },
    loadCategories() {
      axios
        .get("/jobs-categories")
        .then((data) => {
          this.categories = data.data;
        })
        .catch(() => {
          console.log("Error......");
        });
      //pick data from controller and push it into products object
    },
    filterJobs() {
      this.loading = true;
      this.search_keyword.length === 0
        ? this.getResults()
        : axios
            .get("jobs-list/filter/" + this.search_keyword)
            .then((response) => {
              //   console.log(response.data);
              this.jobs = response.data;
              this.loading = false;
            })
            .catch(function (error) {
              this.loading = false;
              console.log(error);
            });
    },
    advancedFilterJobs() {
      this.loading = true;
      this.form.category_id ||
      this.form.budget_id ||
      this.form.residule_payment ||
      this.form.search_keyword
        ? axios
            .get(
              `jobs-list/advanced/filter?category_id=${
                this.form.category_id !== null ? this.form.category_id : ""
              }&budget_id=${
                this.form.budget_id !== null ? this.form.budget_id : ""
              }&residule_payment=${
                this.form.residule_payment === true
                  ? this.form.residule_payment
                  : ""
              }&search_keyword=${this.form.search_keyword}`
            )
            .then((response) => {
              this.jobs = response.data;
              this.loading = false;
              this.closeModalWindow();
            })
            .catch(function (error) {
              this.loading = false;
              console.log(error);
              this.closeModalWindow();
            })
        : this.closeModalWindow();
    },
  },
  created() {
    // console.log(this.user);
    this.getResults();
    this.loadCategories();
    this.loadBudgets();
    Fire.$on("AfterClearFiltertLoadIt", () => {
      //custom events fire on
      this.getResults();
    });
  },
};
</script>
<style scoped>
.rounded-corners {
  border-radius: 100px;
  border: 0;
}
.jbContainer {
    word-wrap: break-word;
}
</style>
