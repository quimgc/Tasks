<template>


    <div>

        <!--<div class="box-body">-->
            <!--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-description">-->
                <!--Launch Default Modal-->
            <!--</button>-->
        <!--</div>-->
        <div class="modal fade" id="modal-description">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Description</h4>
                    </div>
                    <div class="modal-body">

                        <quill-editor v-model="taskForEditDescription.description">

                        </quill-editor>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <!--@click="editing=!editing" això estava al button de Update nse quina funcionalitat tenia xd  -->
                        <button type="button" class="btn btn-primary" @click="changeDescriptionTask(taskForEditDescription)">Update</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <widget :loading="loading">
        <p slot="title">Tasques</p>
        <div v-cloak>

            <table class="table table-bordered table-hover">
                <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th>Task</th>
                    <th>Completed</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(task, index) in filteredTasks">
                    <td>{{ index + 1}}</td>
                    <td>{{ task.name }}</td>
                    <td> <toggle-button :value="task.completed" @change="isCompletedTask(task)" v-model="task.completed"/> </td>
                    <td class="description" @click="editDescription(task)" v-html="task.description" data-toggle="modal" data-target="#modal-description"> </td>
                    <td>Action</td>

                </tr>

                </tbody>
            </table>


            <!--<ul>-->
                <!--<li v-for="task in filteredTasks" v-bind:class="{completed : isCompleted(task) }"-->
                    <!--@dblclick="editTask(task)">-->

                    <!--<input type="text" id="editedTask" v-if="editedTask==task"-->
                           <!--v-model="modifyTask"-->
                           <!--@keydown.enter="updateTask(task)"-->
                           <!--@keyup.esc="cancelEdit(task)">-->


                    <!--<div v-else>-->

                        <!--{{task.name}}-->

                        <!--<i class="fa fa-pencil" aria-hidden="true" @click="updateTask(task)"></i>-->
                        <!--<i class="fa fa-refresh fa-spin fa-lg" v-if="task.id === taskBeingDeleted"></i>-->
                        <!--<i class="fa fa-times" v-else aria-hidden="true" @click="deleteTask(task)"></i>-->
                        <!--<i class="fa fa-check" aria-hidden="true" @click="doneTask(task)"></i>-->

                    <!--</div>-->

                <!--</li>-->
            <!--</ul>-->
            <div class="form-group has-feedback" :class="{'has-error': form.errors.has('user_id')}">
                <label for="user_id">User</label>
                <transition name="fade">
                    <span v-text="form.errors.get('user_id')" v-if="form.errors.has('user_id')" class="help-block"></span>
                </transition>
                <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">-->
                <users @select="userSelected" id="user_id" name="user_id" v-model="form.user_id" :value="form.user_id"></users>
            </div>

            <div class="form-group has-feedback" :class="{'has-error': form.errors.has('name')}">
                <label for="name">Task Name</label>
                <transition name="fade">
                    <span v-text="form.errors.get('name')" v-if="form.errors.has('name')" class="help-block"></span>
                </transition>
                <input @input="form.errors.clear('name')" class="form-control" type="text" v-model="form.name" id="name" name="name" @keyup.enter="addTask">
            </div>


            <div class="btn-group">
                <button @click="show('all')" :class="{active: this.filter =='all'}"> All</button>
                <button @click="show('completed')" :class="{active: this.filter =='completed'}">Completed</button>
                <button @click="show('pending') " :class="{active: this.filter =='pending'}">Pending</button>

            </div>

            <h2>Tasques pendents: </h2>

            <ul>
                {{this.pendingTaskCounter}}
            </ul>

        </div>

        <p slot="footer">
            <button :disabled="form.submitting || form.errors.any()" id="add" @click="addTask" class="btn btn-primary">
                <i class="fa fa-refresh fa-spin fa-lg" v-if="form.submitting"></i>
                Afegir Tasca
            </button>
        </p>
    </widget>

    <message title="Message" message="" color="info"></message>


    </div>
</template>

<style src="quill/dist/quill.snow.css"></style>

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
</style>


<script>
    import Users from './Users'
    import Form from 'acacha-forms'
    import Quill from 'quill'

    // require styles
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import { quillEditor } from 'vue-quill-editor'

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
      components: { Users, quillEditor },

        data() {
            return {
              loading: false,
              editedTask: null,
              filter: 'all',
              tasks: [],
              taskBeingDeleted: null,
              modifyTask: '',
              descriptionTask: '',
              //editing: false,
              taskForEditDescription: [],
              form: new Form({user_id:'', name: '', id: ''})
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
        watch: {
            tasks: function() {
//          localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(this.tasks))
            }
        },
        methods: {

        userSelected(user) {

          this.form.user_id = user.id;
        },
            show(filter) {
                this.filter = filter
            },
            addTask() {
          console.log("addTask");
                let pos = (this.tasks.length)+1;
                let url = API_URL
              console.log("pos " + pos);
                this.form.post(url).then((response) =>  {
                    this.tasks.push({ name : this.form.name, id: pos, user_id: this.form.user_id, completed : false})
                    this.form.name=''

                }).catch((error) => {
                    flash(error.message)
                })

            },
            isCompleted(task) {
                return task.completed
            },
            isCompletedTask(task) {

                //TODO quan faig clic a COMPLETED, només surt el tic verd al primer!!!!!
                console.log('completTask');
                console.log(task);

              let url = '/api/v1/completed-tasks/'+task.id
              axios.put(url, {completed: task.completed }).then((response) =>  {
                var pos =   this.tasks.indexOf(task);
                this.tasks[pos].completed = task.completed;

              }).catch((error) => {
                flash(error.message)
              }).then(()=>{
                this.$emit('loading',false)
              })

            },

            deleteTask(task) {


                let url = '/api/v1/tasks/' + task.id
                this.taskBeingDeleted = task.id
                axios.delete(url).then( (response) => {
                    this.tasks.splice( this.tasks.indexOf(task) , 1 )
                }).catch( (error) => {
                    flash(error.message)
                }).then(
                    this.taskBeingDeleted = null
                )
            },
             updateTask(task){
                console.log("update");
                this.updating = true
                let url = '/api/v1/tasks/'+task.id
                console.log(url);
                console.log(task);
                axios.put(url, {name: this.modifyTask }).then((response) =>  {
                var pos =   this.tasks.indexOf(task);
                console.log("indexOf(task) "+ pos);

                this.tasks[pos].name = this.modifyTask;
                console.log(this.tasks[pos].name );
                this.modifyTask = ''
                this.editedTask = null
		}).catch((error) => {
                    flash(error.message)
                }).then(()=>{
                    this.$emit('loading',false)
                    this.updating = false
             })

            },
            editTask(task){
                this.editedTask = task;
                this.modifyTask = task.name;
                console.log("edit");
            },

            editDescription(task) {

                this.taskForEditDescription = task;

            },
          changeDescriptionTask(task){
            let url = '/api/v1/description-tasks/'+task.id
            axios.put(url, {description: task.description }).then((response) =>  {
              var pos =   this.tasks.indexOf(task);
              this.tasks[pos].description = task.description;
              this.taskForEditDescription = []
            }).catch((error) => {
              flash(error.message)
            }).then(()=>{
              this.$emit('loading',false)
            })
          },

            cancelEdit(){
                this.editedTask = null;
                this.modifyTask = ''
            }, doneTask(task){
                 var pos =   this.tasks.indexOf(task);

                    this.tasks[pos].completed = true;

                task.completed = true
            }
        },
        mounted() {
          //var quill = new Quill('#editor', {
            //theme: 'snow'
          //});

            let url = '/api/v1/tasks'

            // PROMISES
          //this.$emit('loading',true)

            this.loading = true;
            //.then(wait(5000))
            axios.get(url).then((response) =>  {
                this.tasks = response.data;

            }).catch((error) => {
                 flash(error.message)
            }).then(()=>{

                this.loading = false
            })

        }
    }
</script>
