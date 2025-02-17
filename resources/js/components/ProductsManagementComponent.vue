<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Products Table</h3>
      <form @submit.prevent="searchProduct()">
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
                @click="searchProduct"
              >
                <i class="fas fa-search"></i>
              </button>
              <button
                class="btn btn-outline-secondary"
                data-toggle="modal"
                data-target="#addNew"
                @click="openModalWindow"
              >
                Add New <i class="fas fa-products-plus fa-fw"></i>
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
            <th>Description</th>
            <th>Price</th>
            <th>Status</th>
            <th>Vendor</th>
            <th>Registered At</th>
            <th>Modify</th>
          </tr>

          <tr v-for="product in products.data" :key="product.id">
            <td>{{ product.id }}</td>
            <td>
              {{ product.name }}
            </td>
            <td v-html="product.description"></td>
            <td>{{ product.price }}</td>
            <td>
              {{ product.status == 1 ? "Active" : "InActive" }}
            </td>
            <td>{{ product.vendor.vendor_station }}</td>
            <td>{{ product.created_at | formatDate }}</td>
            <td>
              <div class="btn-group">
                <button
                  class="btn btn-success btn-sm"
                  data-id="products.id"
                  @click="editModalWindow(product)"
                >
                  Edit <i class="fa fa-edit blue"></i>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteProduct(product.id)"
                >
                  Delete <i class="fa fa-trash red"></i>
                </button>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <pagination
                :data="products"
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
              Add New Product
            </h5>
            <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              Update Product
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

          <form @submit.prevent="editMode ? updateProduct() : createProduct()">
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <label for="isApproved1">Product status:</label><br />
                    <div class="form-check form-check-inline">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="inlineRadioOptions"
                        v-model="form.status"
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
                        v-model="form.status"
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
                        v-model="form.status"
                        id="inlineRadio3"
                        value="2"
                      />
                      <label class="form-check-label" for="inlineRadio3"
                        >Flagged (as inappropriate)</label
                      >
                    </div>
                    <div
                      v-if="form.errors.has('status')"
                      v-html="form.errors.get('status')"
                    />
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Name:</label>
                      <input
                        v-model="form.name"
                        type="text"
                        name="name"
                        maxlength="30"
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
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="price">Price:</label>
                      <input
                        v-model="form.price"
                        type="number"
                        name="price"
                        placeholder="Price"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('price'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('price')"
                        v-html="form.errors.get('price')"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="unique_id">Unique ID:</label>
                      <input
                        v-model="form.unique_id"
                        type="text"
                        name="unique_id"
                        placeholder="Unique Code"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('unique_id'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('unique_id')"
                        v-html="form.errors.get('unique_id')"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="category_id">Category:</label>
                      <select
                        name="category_id"
                        v-model="form.category_id"
                        id="category_id"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('category_id'),
                        }"
                      >
                        <option
                          v-for="(category, index) in categories.data"
                          v-bind:value="category.id"
                          :key="index"
                        >
                          {{ category.name }}
                        </option>
                      </select>
                      <div
                        v-if="form.errors.has('category_id')"
                        v-html="form.errors.get('category_id')"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="vendor_id">Vendor:</label>
                      <select
                        name="vendor_id"
                        v-model="form.vendor_id"
                        id="vendor_id"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('vendor_id'),
                        }"
                      >
                        <option
                          v-for="(vendor, index) in vendors.data"
                          v-bind:value="vendor.id"
                          :key="index"
                        >
                          {{ vendor.vendor_station }}
                        </option>
                      </select>
                      <div
                        v-if="form.errors.has('vendor_id')"
                        v-html="form.errors.get('vendor_id')"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description">Description:</label>
                      <textarea
                        v-model="form.description"
                        id="description"
                        name="description"
                        placeholder="Product description..."
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
                :disabled="loadingCreateProduct || loadingUpdateProduct"
              >
                Close
              </button>
              <button
                v-show="editMode"
                type="submit"
                class="btn btn-primary"
                :disabled="loadingCreateProduct"
              >
                <span v-show="!loadingUpdateProduct"> Update </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingUpdateProduct"
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
                :disabled="loadingCreateProduct"
              >
                <span v-show="!loadingCreateProduct"> Create </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingCreateProduct"
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
      products: {},
      vendors: {},
      search_keyword: "",
      categories: {},
      loadingCreateProduct: false,
      loadingUpdateProduct: false,
      loadingResidulePayment: false,
      roleErrors: null,
      form: new Form({
        id: "",
        name: "",
        description: "",
        price: "",
        image: " ",
        colors: "",
        status: "",
        unique_id: "",
        vendor_id: 1,
        category_id: 1,
        influencer_code: "",
      }),
    };
  },
  methods: {
    editModalWindow(products) {
      this.form.clear();
      this.editMode = true;
      this.form.reset();
      this.form.fill(products);
      $("#addNew").modal("show");
      this.form.fill(products);
    },
    updateProduct() {
      this.loadingUpdateProduct = true;
      this.form
        .put("api/v1/products/" + this.form.id)
        .then((res) => {
          this.loadingUpdateProduct = false;
          Toast.fire({
            icon: "success",
            title: "Product updated successfully",
          });

          Fire.$emit("AfterCreatedProductLoadIt");

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingUpdateProduct = false;
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
    loadProducts() {
      this.$Progress.start();
      axios
        .get("api/v1/products")
        .then((data) => {
          this.products = data.data;
          this.$Progress.finish();
        })
        .catch(() => {
          console.log("Error......");
          this.$Progress.finish();
        });

      //pick data from controller and push it into products object
    },
    getResults(page = 1) {
      axios
        .get("api/v1/products?page=" + page)
        .then((data) => {
          this.products = data.data;
        })
        .catch(() => {
          console.log("Error......");
        });
    },

    searchProduct() {
      this.search_keyword.length === 0
        ? this.loadProducts()
        : axios
            .get("api/v1/products/filter/" + this.search_keyword)
            .then((data) => {
              this.products = data.data;
            })
            .catch(() => {
              console.log("Error......");
            });

      //pick data from controller and push it into products object
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

      //pick data from controller and push it into products object
    },
    loadVendors() {
      axios
        .get("api/v1/vendors")
        .then((data) => {
          this.vendors = data.data;
        })
        .catch(() => {
          console.log("Error......");
        });

      //pick data from controller and push it into products object
    },

    createProduct() {
      this.loadingCreateProduct = true;
      this.form
        .post("api/v1/products")
        .then((res) => {
          this.loadingCreateProduct = false;
          Fire.$emit("AfterCreatedProductLoadIt"); //custom events

          Toast.fire({
            icon: "success",
            title: "Product created successfully",
          });

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingCreateProduct = false;
          console.log("Error......");
        });

      //this.loadProducts();
    },
    deleteProduct(id) {
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
            .delete("api/v1/products/" + id)
            .then((response) => {
              Swal.fire("Deleted!", "Product deleted successfully", "success");
              this.loadProducts();
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
    this.loadProducts();
    this.loadCategories();
    this.loadVendors();
    Fire.$on("AfterCreatedProductLoadIt", () => {
      //custom events fire on
      this.loadProducts();
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
