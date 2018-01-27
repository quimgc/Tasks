<template>


    <div>




        <!--Show or Edit Task-->


        <div class="modal fade" id="modal-task">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Task information</h4>
                    </div>
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>{{ taskForEdit.task.name }}</b></h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                            <div v-if="taskForEdit.editing == false" class="box-body">
                                <div class="form-group">
                                    <label>User id</label>
                                    <input readonly type="text" class="form-control":value="taskForEdit.task.user_id">
                                </div>
                                <div class="form-group">
                                    <label>Task name</label>
                                    <input readonly type="text" class="form-control":value="taskForEdit.task.name">
                                </div>
                                <div class="form-group">
                                    <label>Completed</label>
                                    <input readonly type="text" class="form-control":value="taskForEdit.task.completed">
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <td readonly type="text" class="form-control" v-html="taskForEdit.task.description"> </td>
                                </div>
                            </div>
                            <!-- /.box-body -->




                            <div v-if="taskForEdit.editing == true"  class="box-body">
                                <div class="form-group">
                                    <label>User id</label>
                                    <input  type="text" class="form-control" :value="taskForEdit.task.user_id">
                                </div>
                                <div class="form-group">
                                    <label>Task name</label>
                                    <input type="text" class="form-control" v-model="taskForEdit.task.name">
                                </div>
                                <div class="form-group">
                                    <label>Completed</label>
                                    <toggle-button :value="taskForEdit.task.completed" @change="isCompletedTask(taskForEdit.task)" v-model="taskForEdit.task.completed"/>

                                    <!--<input type="text" class="form-control" :value="taskForEdit.task.completed">-->
                                </div>

                                <div>
                                    <label>Description</label>
                                    <td v-if="editor == 'medium-editor'">

                                        <medium-editor :text='taskForEdit.task.description' v-on:edit="recordingNewDescription"></medium-editor>

                                    </td>

                                    <td v-if="editor == 'quill'">

                                        <quill-editor v-model="taskForEdit.task.description">

                                        </quill-editor>

                                    </td>

                                </div>

                            </div>


                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button v-if="taskForEdit.editing == true" @click="saveTask" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>


        <widget :loading="loading">
        <p slot="title">Tasques</p>
        <div v-cloak>

            <table class="table table-bordered table-hover">
                <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th>Task</th>
                    <th>Owner</th>
                    <th>Completed</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(task, index) in filteredTasks">
                    <td>{{index +1 }}</td>
                    <td>{{task.name}}</td>
                    <td>{{task.user_id}}</td>
                    <td class="align-center"> <toggle-button :value="task.completed" @change="isCompletedTask(task)" v-model="task.completed"/> </td>
                    <!--<td class="description" @click="takeTaskForEdit(task, index)" v-html="task.description" data-toggle="modal" data-target="#modal-description"></td>-->

                    <td v-if="editor == 'medium-editor'" class="description" @click="takeTaskForEdit(task, index)">


                        <medium-editor :text='task.description' v-on:edit="recordingNewDescription"></medium-editor>

                    </td>


                    <td v-if="editor == 'quill'" class="description" @click="takeTaskForEdit(task, index)">

                        <div v-if="index == taskForEdit.index && taskForEdit.editing == true">

                            <quill-editor v-model="taskForEdit.task.description"> </quill-editor>

                        </div>

                        <div v-if="taskForEdit.index != index" v-html="task.description"></div>

                    </td>


                    <td class="action">
                        <div class="align-center btn-group">
                            <button v-if="index == taskForEdit.index && taskForEdit.editing == true" type="button" @click="saveTask" class="btn btn-default" alt="Save Task">
                                <i class="fa fa-floppy-o"></i>
                            </button>
                            <button @click="btnShowTask(task)" type="button" data-toggle="modal" data-target="#modal-task" class="btn btn-success">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button @click="btnEditTask(task, index)" data-toggle="modal" data-target="#modal-task" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button @click="proves('drop')" type="button" class="btn btn-danger">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </td>


                </tr>

                </tbody>
            </table>


            <div class="form-group has-feedback" :class="{'has-error': form.errors.has('user_id')}">
                <label for="user_id">User</label>
                <transition name="fade">
                    <span v-text="form.errors.get('user_id')" v-if="form.errors.has('user_id')" class="help-block"></span>
                </transition>
                <users @select="userSelected" id="user_id" name="user_id" v-model="form.user_id" :value="form.user_id"></users>
            </div>

            <div class="form-group has-feedback" :class="{'has-error': form.errors.has('name')}">
                <label for="name">Task Name</label>
                <transition name="fade">
                    <span v-text="form.errors.get('name')" v-if="form.errors.has('name')" class="help-block"></span>
                </transition>
                <input @input="form.errors.clear('name')" class="form-control" type="text" v-model="form.name" id="name" name="name">
            </div>

            <div class="form-group has-feedback" :class="{'has-error': form.errors.has('description')}">
                <label for="description">Task Description</label>
                <transition name="fade">
                    <span v-text="form.errors.get('description')" v-if="form.errors.has('description')" class="help-block"></span>
                </transition>
                <input @input="form.errors.clear('description')" class="form-control" type="text" v-model="form.description" id="description" name="description" @keydown.enter="addTask">
            </div>

            <p>
                <button :disabled="form.submitting || form.errors.any()" id="add" @click="addTask" class="btn btn-primary">
                    <i class="fa fa-refresh fa-spin fa-lg" v-if="form.submitting"></i>
                    Afegir Tasca
                </button>
            </p>

            <div class="btn-group">
                <button @click="show('all')" :class="{active: this.filter =='all'}"> All</button>
                <button @click="show('completed')" :class="{active: this.filter =='completed'}">Completed</button>
                <button @click="show('pending') " :class="{active: this.filter =='pending'}">Pending</button>

            </div>

            <div slot="footer">

                <h2>Tasques pendents: </h2>

                <ul>
                    {{this.pendingTaskCounter}}
                </ul>

            </div>

        </div>


        </widget>

        <message title="Message" message="" color="info"></message>


    </div>
</template>

<style src="quill/dist/quill.snow.css"></style>
<style src="medium-editor/dist/css/medium-editor.min.css"></style>
<style src="medium-editor/dist/css/themes/default.min.css"></style>

<style>

    [v-cloak] { display: none; }
    li.completed {
        text-decoration: line-through;
    }

    li.active {
        background-color: #cdffe4;
    }


    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter, .fade-leave-to{
        opacity: 0;
    }
    .description{

        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;

    }

    .action{

        width: 150px;

    }

    .align-center{

        display: flex;
            justify-content: center;
    }
</style>


<script>

  import Users from './Users'
  import Form from 'acacha-forms'

  //editors
  import Quill from 'quill'
  import { quillEditor } from 'vue-quill-editor'
  import MediumEditor from 'medium-editor'
  import editor from 'vue2-medium-editor'

  // require styles
  import 'quill/dist/quill.core.css'
  import 'quill/dist/quill.snow.css'
  import 'quill/dist/quill.bubble.css'


  //importo fitxer de conf. per escollir l'editor
  import { config } from '../config/tasks.js'


  // visibility filters
  var filters = {
    all: function (tasks) {

      return tasks
    },
    pending : function (tasks) {
      return tasks.filter(function (task) {
        return !task.completed

      })
    },
    completed: function (tasks) {
      return tasks.filter(function (task) {
        return task.completed
      })
    }
  }

  const API_URL = '/api/v1/tasks';
  const LOCAL_STORAGE_KEY = 'TASKS';


  import { wait } from './utils.js'


  export default {
    components: { Users, quillEditor, 'medium-editor': editor },

    data() {
      return {
        loading: false,
        tasks: [],
        filter: 'all',
        editor: config.editor,
        taskForEdit: {
          index: -1,
          task: [],
          editing: false,

        },
        modifiedDescription: '',

        form: new Form({user_id:'', name: '', id: '', description: ''})
      }
    },

    computed: {
      filteredTasks() {

        return filters[this.filter](this.tasks)
      },
      pendingTaskCounter: function(){
        return filters.pending(this.tasks).length

      }

    },

    methods: {

      show(filter){

        this.filter = filter
      },

      userSelected(user) {

        this.form.user_id = user.id;
      },

      addTask() {

        let pos = (this.tasks.length)+1;
        let url = API_URL
        this.form.post(url).then((response) =>  {

          this.tasks.push({ name : this.form.name, id: pos, user_id: this.form.user_id, description: this.form.description, completed : false})
          this.form.name=''
          this.form.description=''


        }).catch((error) => {
          flash(error.message)
        })

      },

      takeTaskForEdit(task, index){

        this.taskForEdit.task = task;
        this.taskForEdit.index = index;
        this.taskForEdit.editing = true;
      },

      recordingNewDescription(task) {

        this.modifiedDescription = task.api.origElements.innerHTML;

      },

      prova(){

//        console.log(this.taskForEdit);
        console.log("alo");
      },

      saveTask() {

        var description = '';
        let url = '/api/v1/description-tasks/'+this.taskForEdit.task.id;
        var pos = this.taskForEdit.index;


        (this.editor == 'medium-editor') ? description = this.modifiedDescription : description = this.taskForEdit.task.description;

        axios.put(url, {description: description }).then((response) =>  {

          this.tasks[pos].description = description;

        }).catch((error) => {

            flash(error.message)

        }).then(()=>{
          this.taskForEdit.task = [];
          this.taskForEdit.index = -1;
          this.taskForEdit.editing = false;

          this.$emit('loading',false)

        })

      },
      isCompletedTask(task){

        let url = '/api/v1/completed-tasks/'+task.id
        var pos =   this.tasks.indexOf(task);

        axios.put(url, {completed: task.completed }).then((response) =>  {

            this.tasks[pos].completed = task.completed;

        }).catch((error) => {

            flash(error.message)

        }).then(()=>{

          this.$emit('loading',false)

        })

      },

      btnShowTask(task){

        this.taskForEdit.task = task;
        this.taskForEdit.editing = false;

      },

      btnEditTask(task, index){


        this.taskForEdit.task = task;
        this.taskForEdit.index = index;
        this.taskForEdit.editing = true;
      },


    },
    mounted() {


      this.loading = true;

      axios.get(API_URL).then((response) =>  {
        this.tasks = response.data;

      }).catch((error) => {
        flash(error.message)
      }).then(()=>{

        this.loading = false
      })

    }
  }
</script>
