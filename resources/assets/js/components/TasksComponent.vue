<template>
    <div>
    <widget :loading="loading">
        <p slot="title">Tasques</p>

        <div v-cloak>


            <ul>
                <li v-for="task in filteredTasks" v-bind:class="{completed : isCompleted(task) }"
                    @dblclick="editTask(task)">

                    <input type="text" id="editedTask" v-if="editedTask==task"
                           v-model="modifyTask"
                           @keydown.enter="updateTask(task)"
                           @keyup.esc="cancelEdit(task)"
                           @keyup.enter="doneEdit(task)">


                    <div v-else>

                        {{task.name}}

                        <i class="fa fa-pencil" aria-hidden="true" @click="updateTask(task)"></i>
                        <i class="fa fa-refresh fa-spin fa-lg" v-if="task.id === taskBeingDeleted"></i>
                        <i class="fa fa-times" v-else aria-hidden="true" @click="deleteTask(task)"></i>
                        <i class="fa fa-check" aria-hidden="true" @click="doneTask(task)"></i>

                    </div>

                </li>
            </ul>
            <div class="form-group">
                <label for="user_id">User</label>
                <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">-->
                <users id="user_id" name="user_id"></users>


            </div>

            <div class="form-group has-feedback" :class="{'has-error': form.errors.has('name')}">
                <label for="form.name">Task Name</label>
                <input class="form-control" type="text" v-model="form.name" id="form.name" @keyup.enter="addTask">
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

        <p slot="footer"></p>
        <button id="add" :disabled="form.submitting" @click="addTask" class="btn btn-primary">
            <i class="fa fa-refresh fa-spin fa-lg" v-if="form.submitting"></i>
            Afegir Tasca
        </button>
    </widget>

    <message title="Message" message="" color="info"></message>


    </div>
</template>

<style>

    [v-cloak] { display: none; }
    li.completed {
        text-decoration: line-through;
    }

    li.active {
        background-color: #cdffe4;
    }

</style>


<script>
    import Users from './Users'
    import Form from 'acacha-forms'


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

    const LOCAL_STORAGE_KEY = 'TASKS'


    import { wait } from './utils.js'


    export default {
      components: { Users },

        data() {
            return {
              loading: false,
                editedTask: null,
                filter: 'all',
                tasks: [],
                updating: false,
                taskBeingDeleted: null,
                modifyTask: '',
              form: new Form({user_id:'', name: ''})
            }
        },
        props: ['id','name'],
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
            show(filter) {
                this.filter = filter
            },
            addTask() {

                let url = '/api/tasks'

                this.form.post(url ).then((response) =>  {
                    this.tasks.push({ name : this.form.name, user_id: this.form.user_id, completed : false})
                    this.form.name=''

                }).catch((error) => {
                    flash(error.message)
                })

            },
            isCompleted(task) {
                return task.completed
            },
            deleteTask(task) {


                let url = '/api/tasks/' + task.id
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

                this.updating = true
                let url = '/api/tasks/' + task.id
                axios.put(url, {name: this.modifyTask }).then((response) =>  {
                  var pos =   this.tasks.indexOf(task);

                  this.tasks[pos].name = this.modifyTask;
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
//        this.tasks = JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY) || '[]')
            console.log(this.tasks)

            // TODO Connectat a Internet i agafam la llista de tasques
//        this.tasks = ???

            // HTTP CLIENT
          //TODO refactor url api/v1/tasks
            let url = '/api/tasks'

            // PROMISES
          //this.$emit('loading',true)

            this.loading = true;
            //.then(wait(5000))
            axios.get(url).then((response) =>  {
                this.tasks = response.data;

            }).catch((error) => {
                 flash(error.message)
            }).then(()=>{
                //this.$emit('loading',false)
                this.loading = false
            })

//        setTimeout( () => {
//          component.hide()
//        },3000)



            // API HTTP amb JSON <- Web service
            // URL GET http://NOM_SERVIDOR/api/task
            // URL POST http://NOM_SERVIDOR/api/task
            // URL DELETE http://NOM_SERVIDOR/api/task/{task}
            // URL PUT/PATCH http://NOM_SERVIDOR/api/task/{task}
        }
    }
</script>
