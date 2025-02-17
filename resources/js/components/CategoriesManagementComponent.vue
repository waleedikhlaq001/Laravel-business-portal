<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Categories Table</h3>
      <form @submit.prevent="searchCategory()">
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
                @click="searchCategory"
              >
                <i class="fas fa-search"></i>
              </button>
              <button
                class="btn btn-outline-secondary"
                data-toggle="modal"
                data-target="#addNew"
                @click="openModalWindow"
              >
                Add New <i class="fas fa-categories-plus fa-fw"></i>
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
            <th>Residule(Parent category)</th>
            <th>Registered At</th>
            <th>Modify</th>
          </tr>

          <tr v-for="category in categories.data" :key="category.id">
            <td>{{ category.id }}</td>
            <td>
              {{ category.name }}
            </td>
            <td>
              <p v-if="category.residule">
                <span v-html="category.residule.name"></span>
              </p>
            </td>
            <td>{{ category.created_at | formatDate }}</td>
            <td>
              <div class="btn-group">
                <button
                  class="btn btn-success btn-sm"
                  data-id="categories.id"
                  @click="editModalWindow(category)"
                >
                  Edit <i class="fa fa-edit blue"></i>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteCategory(category.id)"
                >
                  Delete <i class="fa fa-trash red"></i>
                </button>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <pagination
                :data="categories"
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
              Add New Category
            </h5>
            <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              Update Category
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
            @submit.prevent="editMode ? updateCategory() : createCategory()"
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
                      <label for="residule_id"
                        >Residule(Parent category):</label
                      >
                      <select
                        name="residule_id"
                        v-model="form.residule_id"
                        id="residule_id"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('residule_id'),
                        }"
                      >
                        <option
                          v-for="(residul, index) in residulepayments.data"
                          v-bind:value="residul.id"
                          :key="index"
                        >
                          {{ residul.name }}
                        </option>
                      </select>
                      <div
                        v-if="form.errors.has('residule_id')"
                        v-html="form.errors.get('residule_id')"
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
                :disabled="loadingCreateCategory || loadingUpdateCategory"
              >
                Close
              </button>
              <button
                v-show="editMode"
                type="submit"
                class="btn btn-primary"
                :disabled="loadingCreateCategory"
              >
                <span v-show="!loadingUpdateCategory"> Update </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingUpdateCategory"
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
                :disabled="loadingCreateCategory"
              >
                <span v-show="!loadingCreateCategory"> Create </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingCreateCategory"
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
      categories: {},
      search_keyword: "",
      residulepayments: {},
      loadingCreateCategory: false,
      loadingUpdateCategory: false,
      loadingResidulePayment: false,
      roleErrors: null,
      form: new Form({
        id: "",
        name: "",
        residule_id: 1,
      }),
    };
  },
  methods: {
    editModalWindow(categories) {
      this.form.clear();
      this.editMode = true;
      this.form.reset();
      this.form.fill(categories);
      $("#addNew").modal("show");
      this.form.fill(categories);
    },
    updateCategory() {
      this.loadingUpdateCategory = true;
      this.form
        .put("api/v1/categories/" + this.form.id)
        .then((res) => {
          this.loadingUpdateCategory = false;
          Toast.fire({
            icon: "success",
            title: "Category updated successfully",
          });

          Fire.$emit("AfterCreatedCategoryLoadIt");

          $("#addNew").modal("hide");
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
    loadCategories() {
      this.$Progress.start();
      axios
        .get("api/v1/categories")
        .then((data) => {
          this.categories = data.data;
          this.$Progress.finish();
        })
        .catch(() => {
          console.log("Error......");
          this.$Progress.finish();
        });

      //pick data from controller and push it into categories object
    },
    getResults(page = 1) {
      axios
        .get("api/v1/categories?page=" + page)
        .then((data) => {
          this.categories = data.data;
        })
        .catch(() => {
          console.log("Error......");
        });
    },

    searchCategory() {
      this.search_keyword.length === 0
        ? this.loadCategories()
        : axios
            .get("api/v1/categories/filter/" + this.search_keyword)
            .then((data) => {
              this.categories = data.data;
            })
            .catch(() => {
              console.log("Error......");
            });

      //pick data from controller and push it into categories object
    },
    loadResidulePayment() {
      this.loadingResidulePayment = true;
      axios
        .get("api/v1/residules")
        .then((data) => {
          this.residulepayments = data.data;
          this.loadingResidulePayment = false;
        })
        .catch(() => {
          console.log("Error......");
          this.loadingResidulePayment = false;
        });

      //pick data from controller and push it into categories object
    },

    createCategory() {
      this.loadingCreateCategory = true;
      this.form
        .post("api/v1/categories")
        .then((res) => {
          this.loadingCreateCategory = false;
          Fire.$emit("AfterCreatedCategoryLoadIt"); //custom events

          Toast.fire({
            icon: "success",
            title: "Category created successfully",
          });

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingCreateCategory = false;
          console.log("Error......");
        });

      //this.loadCategories();
    },
    deleteCategory(id) {
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
            .delete("api/v1/categories/" + id)
            .then((response) => {
              Swal.fire("Deleted!", "Category deleted successfully", "success");
              this.loadCategories();
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
    this.loadCategories();
    this.loadResidulePayment();
    Fire.$on("AfterCreatedCategoryLoadIt", () => {
      //custom events fire on
      this.loadCategories();
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