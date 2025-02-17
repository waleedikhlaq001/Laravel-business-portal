<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Residules Table</h3>
      <form @submit.prevent="searchResidule()">
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
                @click="searchResidule"
              >
                <i class="fas fa-search"></i>
              </button>
              <button
                class="btn btn-outline-secondary"
                data-toggle="modal"
                data-target="#addNew"
                @click="openModalWindow"
              >
                Add New <i class="fas fa-plus fa-fw"></i>
              </button>
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
            <th>Percentage</th>
            <th>Registered At</th>
            <th>Modify</th>
          </tr>

          <tr v-for="residule in residules.data" :key="residule.id">
            <td>{{ residule.id }}</td>
            <td>
              {{ residule.name }}
            </td>
            <td>
              {{ residule.percentage }}
            </td>
            <td>{{ residule.created_at | formatDate }}</td>

            <td>
              <div class="btn-group">
                <button
                  class="btn btn-success btn-sm"
                  data-id="residules.id"
                  @click="editModalWindow(residule)"
                >
                  Edit <i class="fa fa-edit blue"></i>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteResidule(residule.id)"
                >
                  Delete <i class="fa fa-trash red"></i>
                </button>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <pagination
                :data="residules"
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
              Add New Residule
            </h5>
            <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              Update Residule
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

          <form
            @submit.prevent="editMode ? updateResidule() : createResidule()"
          >
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Name:</label>
                      <input
                        v-model="form.name"
                        type="text"
                        name="name"
                        placeholder="Residule Name"
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
                      <label for="name">Percentage:</label>
                      <input
                        v-model="form.percentage"
                        type="text"
                        name="percentage"
                        placeholder="Percentage"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('percentage'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('percentage')"
                        v-html="form.errors.get('percentage')"
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
                :disabled="loadingCreateResidule || loadingUpdateResidule"
              >
                Close
              </button>
              <button
                v-show="editMode"
                type="submit"
                class="btn btn-primary"
                :disabled="loadingCreateResidule"
              >
                <span v-show="!loadingUpdateResidule"> Update </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingUpdateResidule"
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
                :disabled="loadingCreateResidule"
              >
                <span v-show="!loadingCreateResidule"> Create </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingCreateResidule"
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
      residules: {},
      countries: {},
      search_keyword: null,
      debounce: null,
      residulepayments: {},
      loadingCreateResidule: false,
      loadingUpdateResidule: false,
      loadingResidulePayment: false,
      roleErrors: null,
      form: new Form({
        id: "",
        name: "",
        percentage: 0,
      }),
    };
  },
  methods: {
    editModalWindow(residules) {
      this.form.clear();
      this.editMode = true;
      this.form.reset();
      this.form.fill(residules);
      $("#addNew").modal("show");
      this.form.fill(residules);
    },
    updateResidule() {
      this.loadingUpdateResidule = true;
      this.form
        .put("api/v1/residules/" + this.form.id)
        .then((res) => {
          this.loadingUpdateResidule = false;
          Toast.fire({
            icon: "success",
            title: "Residule updated successfully",
          });

          Fire.$emit("AfterCreatedResiduleLoadIt");

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingUpdateResidule = false;
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
    loadResidules() {
      this.$Progress.start();
      axios
        .get("api/v1/residules")
        .then((data) => {
          this.residules = data.data;
          this.$Progress.finish();
        })
        .catch(() => {
          console.log("Error......");
          this.$Progress.finish();
        });

      //pick data from controller and push it into residules object
    },
    getResults(page = 1) {
      axios
        .get("api/v1/residules?page=" + page)
        .then((data) => {
          this.residules = data.data;
        })
        .catch(() => {
          console.log("Error......");
        });
    },
    searchResidule() {
      this.search_keyword
        ? this.loadResidules()
        : axios
            .get("api/v1/residules/filter/" + this.search_keyword)
            .then((data) => {
              this.residules = data.data;
            })
            .catch(() => {
              console.log("Error......");
            });

      //pick data from controller and push it into residules object
    },
    createResidule() {
      this.loadingCreateResidule = true;
      this.form
        .post("api/v1/residules")
        .then((res) => {
          this.loadingCreateResidule = false;
          Fire.$emit("AfterCreatedResiduleLoadIt"); //custom events

          Toast.fire({
            icon: "success",
            title: "Residule created successfully",
          });

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingCreateResidule = false;
          console.log("Error......");
        });

      //this.loadResidules();
    },
    deleteResidule(id) {
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
            .delete("api/v1/residules/" + id)
            .then((response) => {
              Swal.fire("Deleted!", "Residule deleted successfully", "success");
              this.loadResidules();
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
    this.loadResidules();
    Fire.$on("AfterCreatedResiduleLoadIt", () => {
      //custom events fire on
      this.loadResidules();
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