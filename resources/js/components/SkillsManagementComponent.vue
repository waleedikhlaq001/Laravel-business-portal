<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Skills Table</h3>
      <form @submit.prevent="searchSkill()">
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
                @click="searchSkill"
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
            <th>Registered At</th>
            <th>Modify</th>
          </tr>

          <tr v-for="skill in skills.data" :key="skill.id">
            <td>{{ skill.id }}</td>
            <td>
              {{ skill.skill }}
            </td>
            <td>{{ skill.created_at | formatDate }}</td>

            <td>
              <div class="btn-group">
                <button
                  class="btn btn-success btn-sm"
                  data-id="skills.id"
                  @click="editModalWindow(skill)"
                >
                  Edit <i class="fa fa-edit blue"></i>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteSkill(skill.id)"
                >
                  Delete <i class="fa fa-trash red"></i>
                </button>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <pagination
                :data="skills"
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
              Add New Skill
            </h5>
            <h5 v-show="editMode" class="modal-title" id="addNewLabel">
              Update Skill
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

          <form @submit.prevent="editMode ? updateSkill() : createSkill()">
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Name:</label>
                      <input
                        v-model="form.skill"
                        type="text"
                        name="skill"
                        placeholder="Skill Name"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors.has('skill'),
                        }"
                      />
                      <div
                        v-if="form.errors.has('skill')"
                        v-html="form.errors.get('skill')"
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
                :disabled="loadingCreateSkill || loadingUpdateSkill"
              >
                Close
              </button>
              <button
                v-show="editMode"
                type="submit"
                class="btn btn-primary"
                :disabled="loadingCreateSkill"
              >
                <span v-show="!loadingUpdateSkill"> Update </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingUpdateSkill"
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
                :disabled="loadingCreateSkill"
              >
                <span v-show="!loadingCreateSkill"> Create </span>
                <!-- IF YOU ARE USING VUE BOOTSTRAP USE <b-spinner label="Loading..."></b-spinner> -->
                <div
                  v-show="loadingCreateSkill"
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
      skills: {},
      countries: {},
      search_keyword: null,
      debounce: null,
      residulepayments: {},
      loadingCreateSkill: false,
      loadingUpdateSkill: false,
      loadingResidulePayment: false,
      roleErrors: null,
      form: new Form({
        id: "",
        skill: "",
      }),
    };
  },
  methods: {
    editModalWindow(skills) {
      this.form.clear();
      this.editMode = true;
      this.form.reset();
      this.form.fill(skills);
      $("#addNew").modal("show");
      this.form.fill(skills);
    },
    updateSkill() {
      this.loadingUpdateSkill = true;
      this.form
        .put("api/v1/skills/" + this.form.id)
        .then((res) => {
          this.loadingUpdateSkill = false;
          Toast.fire({
            icon: "success",
            title: "Skill updated successfully",
          });

          Fire.$emit("AfterCreatedSkillLoadIt");

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingUpdateSkill = false;
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
    loadSkills() {
      this.$Progress.start();
      axios
        .get("api/v1/skills")
        .then((data) => {
          this.skills = data.data;
          this.$Progress.finish();
        })
        .catch(() => {
          console.log("Error......");
          this.$Progress.finish();
        });

      //pick data from controller and push it into skills object
    },
    getResults(page = 1) {
      axios
        .get("api/v1/skills?page=" + page)
        .then((data) => {
          this.skills = data.data;
        })
        .catch(() => {
          console.log("Error......");
        });
    },
    searchSkill() {
      this.search_keyword
        ? this.loadSkills()
        : axios
            .get("api/v1/skills/filter/" + this.search_keyword)
            .then((data) => {
              this.skills = data.data;
            })
            .catch(() => {
              console.log("Error......");
            });

      //pick data from controller and push it into skills object
    },
    createSkill() {
      this.loadingCreateSkill = true;
      this.form
        .post("api/v1/skills")
        .then((res) => {
          this.loadingCreateSkill = false;
          Fire.$emit("AfterCreatedSkillLoadIt"); //custom events

          Toast.fire({
            icon: "success",
            title: "Skill created successfully",
          });

          $("#addNew").modal("hide");
        })
        .catch(() => {
          this.loadingCreateSkill = false;
          console.log("Error......");
        });

      //this.loadSkills();
    },
    deleteSkill(id) {
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
            .delete("api/v1/skills/" + id)
            .then((response) => {
              Swal.fire("Deleted!", "Skill deleted successfully", "success");
              this.loadSkills();
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
    this.loadSkills();
    Fire.$on("AfterCreatedSkillLoadIt", () => {
      //custom events fire on
      this.loadSkills();
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