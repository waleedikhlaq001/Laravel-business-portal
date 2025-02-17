<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Users Table</h3>
      <form @submit.prevent="searchUser()">
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
                @click="searchUser"
              >
                <i class="fas fa-search"></i>
              </button>
              <button
                class="btn btn-outline-secondary"
                data-toggle="modal"
                data-target="#addNew"
                @click="openModalWindow"
              >
                Add New <i class="fas fa-user-plus fa-fw"></i>
              </button>
              <a href="/admin/users-csv"
                class="btn btn-outline-secondary"
              >
                Download CSV <i class="fas fa-user fa-fw"></i>
              </a>
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
            <th>Email</th>
            <th>Type</th>
            <th>Status</th>
            <th>Signup Channel</th>
            <th>Referrer</th>
            <th>Registered At</th>
            <th>Modify</th>
          </tr>

          <tr v-for="user in users.data" :key="user.id">
            <td>{{ user.id }}</td>
            <td>
              {{ user.first_name + " " + user.last_name }}
            </td>
            <td>{{ user.email }}</td>
            <td>
              <p v-for="(role, index) in user.role" :key="index">
                {{ role.name }} {{role.name == "Creative" && user.details !== null? "(" + getFollow(user.details.influencer_followers) + " on " + user.details.influencer_clients + ")" : "" }}
              </p>
            </td>
            <td>
              {{ user.status == 1 ? "Active" : "InActive" }}
            </td>
             <td>{{ user.signup_from }}</td>
             <td>
             {{ user.ambassador ?  user.ambassador.ref_code : 'No Referrer' }}
              <br />
              <button
            v-if="user.ambassador"
            class="btn btn-outline-primary"
             data-id="user.ambassador.id"
            @click="viewuser(user.ambassador)"
          >
            View Ambassador
          </button></td>
            <td>{{ user.created_at | formatDate }}</td>

            <td>
              <div class="btn-group">
                <button
                  class="btn btn-success btn-sm"
                  data-id="user.id"
                  @click="editModalWindow(user)"
                >
                  Edit <i class="fa fa-edit blue"></i>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteUser(user.id)"
                >
                  Delete <i class="fa fa-trash red"></i>
                </button>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <pagination
                :data="users"
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
              Add New User
            </h5>
            <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              Update User
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

          <form @submit.prevent="editMode ? updateUser() : createUser()">
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div :class="!editMode ? 'col-md-6' : 'col-md-12'">
                    <label for="isApproved1"
                      >Account status(Toggle to activate/deactivate):</label
                    ><br />
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
                        >In Active</label
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
                        >Active</label
                      >
                    </div>
                    <div
                      v-if="form.errors.has('status')"
                      v-html="form.errors.get('status')"
                    />
                  </div>
                  <div class="col-md-6" v-if="!editMode">
                    <div class="form-group">
                      <label for="user_role">User role:</label>
                      <select
                        name="role"
                        v-model="form.role"
                        id="user_role"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('role'),
                        }"
                      >
                        <option
                          v-for="(role, index) in roles.data"
                          v-bind:value="role.name"
                          :key="index"
                        >
                          {{ role.name }}
                        </option>
                      </select>
                      <div
                        v-if="form.errors.has('role')"
                        v-html="form.errors.get('role')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="first_name">First name:</label>
                      <input
                        v-model="form.first_name"
                        type="text"
                        name="first_name"
                        placeholder="First name"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('first_name'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('first_name')"
                        v-html="form.errors.get('first_name')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="last_name">Last name:</label>
                      <input
                        v-model="form.last_name"
                        id="last_name"
                        type="text"
                        name="last_name"
                        placeholder="Last name"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('last_name'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('last_name')"
                        v-html="form.errors.get('last_name')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="postal_code">Postal code:</label>
                      <input
                        v-model="form.postal_code"
                        id="postal_code"
                        type="number"
                        name="postal_code"
                        placeholder="Postal code"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('postal_code'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('postal_code')"
                        v-html="form.errors.get('postal_code')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="city">City:</label>
                      <input
                        v-model="form.city"
                        id="city"
                        type="text"
                        name="city"
                        placeholder="City"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('city'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('city')"
                        v-html="form.errors.get('city')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="phone_number">Phone number:</label>
                      <input
                        v-model="form.phone_number"
                        id="phone_number"
                        type="text"
                        name="phone_number"
                        placeholder="Phone number"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('phone_number'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('phone_number')"
                        v-html="form.errors.get('phone_number')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input
                        v-model="form.email"
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Email"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('email'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('email')"
                        v-html="form.errors.get('email')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4" v-if="!editMode">
                    <div class="form-group">
                      <label for="password">Password:</label>
                      <input
                        v-model="form.password"
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter password"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('password'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('password')"
                        v-html="form.errors.get('password')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="country_id">Country:</label>
                      <select
                        name="country_id"
                        v-model="form.country_id"
                        id="country_id"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('country_id'),
                        }"
                      >
                        <option
                          v-for="(country, index) in countries.data"
                          v-bind:value="country.id"
                          :key="index"
                        >
                          {{ country.name }}
                        </option>
                      </select>
                      <div
                        v-if="form.errors.has('country_id')"
                        v-html="form.errors.get('country_id')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="facebook">Facebook:</label>
                      <input
                        v-model="form.facebook"
                        id="facebook"
                        type="text"
                        name="facebook"
                        placeholder="Facebook"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('facebook'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('facebook')"
                        v-html="form.errors.get('facebook')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="instagram">Instagram:</label>
                      <input
                        v-model="form.instagram"
                        type="text"
                        id="instagram"
                        name="instagram"
                        placeholder="Instagram"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('instagram'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('instagram')"
                        v-html="form.errors.get('instagram')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="tiktok">Tiktok:</label>
                      <input
                        v-model="form.tiktok"
                        type="text"
                        id="tiktok"
                        name="tiktok"
                        placeholder="Tiktok"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('tiktok'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('tiktok')"
                        v-html="form.errors.get('tiktok')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="snapchat">Snapchat:</label>
                      <input
                        v-model="form.snapchat"
                        type="text"
                        id="snapchat"
                        name="snapchat"
                        placeholder="Snapchat"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('snapchat'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('snapchat')"
                        v-html="form.errors.get('snapchat')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="telegram">Telegram:</label>
                      <input
                        v-model="form.telegram"
                        type="text"
                        id="telegram"
                        name="telegram"
                        placeholder="telegram"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('telegram'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('telegram')"
                        v-html="form.errors.get('telegram')"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="twitter">Twitter:</label>
                      <input
                        v-model="form.twitter"
                        id="twitter"
                        type="text"
                        name="twitter"
                        placeholder="twitter"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('twitter'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('twitter')"
                        v-html="form.errors.get('twitter')"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="street_address">Street address:</label>
                      <textarea
                        v-model="form.street_address"
                        id="street_address"
                        name="street_address"
                        placeholder="Street address..."
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('street_address'),
                        }"
                        rows="3"
                        max-rows="6"
                      ></textarea>

                      <div
                        v-if="form.errors.has('street_address')"
                        v-html="form.errors.get('street_address')"
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
                :disabled="loadingCreateUser || loadingUpdateUser"
              >
                Close
              </button>
              <button
                v-show="editMode"
                type="submit"
                class="btn btn-primary"
                :disabled="loadingCreateUser"
              >
                <span v-show="!loadingUpdateUser"> Update </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingUpdateUser"
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
                :disabled="loadingCreateUser"
              >
                <span v-show="!loadingCreateUser"> Create </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingCreateUser"
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
      users: {},
      countries: {},
      search_keyword: "",
      roles: {},
      loadingCreateUser: false,
      loadingUpdateUser: false,
      loadingRoes: false,
      roleErrors: null,
      form: new Form({
        id: "",
        email: "",
        password: "",
        first_name: "",
        last_name: "",
        image: "",
        street_address: "",
        postal_code: "",
        city: "",
        phone_number: "",
        status: 0,
        facebook: "",
        instagram: "",
        tiktok: "",
        snapchat: "",
        telegram: "",
        twitter: "",
        country_id: 1,
        role: "General User",
      }),
    };
  },
  methods: {
     getFollow(dt){
     switch(dt) {
      case "Nano Influencers":
        return "1k to 10k followers";
        // code block
        break;
      case "Micro Influencers":
        // code block
        return "10k to 50k followers";
        break;
      case "Mid tier-influencer":
        return "50k to 500k followers";
        break;
      case "Macro Influencers":
        return "500k to 1M followers"
        break;
      case "Mega Influencers":
        return "1M+ followers"
        break;
      default:
        // code block
        return "";
    }
   },
    editModalWindow(user) {
      this.form.clear();
      this.editMode = true;
      this.form.reset();
      this.form.fill(user);
      $("#addNew").modal("show");
      this.form.fill(user);
    },
    viewuser(user) {
      window.location.href = '/admin/ambassadors/'+ user.id;
    },
    updateUser() {
      this.loadingUpdateUser = true;
      this.form
        .put("api/v1/users/" + this.form.id)
        .then((res) => {
          this.loadingUpdateUser = false;
          Toast.fire({
            icon: "success",
            title: "User updated successfully",
          });

          Fire.$emit("AfterCreatedUserLoadIt");

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingUpdateUser = false;
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
    loadUsers() {
      this.$Progress.start();
      axios
        .get("api/v1/users")
        .then((data) => {
          this.users = data.data;
          this.$Progress.finish();
        })
        .catch(() => {
          console.log("Error......");
          this.$Progress.finish();
        });

      //pick data from controller and push it into users object
    },
    getResults(page = 1) {
      axios
        .get("api/v1/users?page=" + page)
        .then((data) => {
          this.users = data.data;
        })
        .catch(() => {
          console.log("Error......");
        });
    },

    searchUser() {
      this.$Progress.start();
      this.search_keyword.length === 0
        ? this.loadUsers()
        : axios
            .get("api/v1/users/filter/" + this.search_keyword)
            .then((data) => {
              this.users = data.data;
              this.$Progress.finish();
            })
            .catch(() => {
              console.log("Error......");
              this.$Progress.finish();
            });

      //pick data from controller and push it into users object
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

      //pick data from controller and push it into users object
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

      //pick data from controller and push it into users object
    },

    createUser() {
      this.loadingCreateUser = true;
      this.form
        .post("api/v1/users")
        .then((res) => {
          this.loadingCreateUser = false;
          Fire.$emit("AfterCreatedUserLoadIt"); //custom events

          Toast.fire({
            icon: "success",
            title: "User created successfully",
          });

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingCreateUser = false;
          console.log("Error......");
        });

      //this.loadUsers();
    },
    deleteUser(id) {
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
            .delete("api/v1/users/" + id)
            .then((response) => {
              Swal.fire("Deleted!", "User deleted successfully", "success");
              this.loadUsers();
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
    this.loadUsers();
    this.loadCountries();
    this.loadRoles();
    Fire.$on("AfterCreatedUserLoadIt", () => {
      //custom events fire on
      this.loadUsers();
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