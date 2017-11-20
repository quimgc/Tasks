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
                <label for="exampleInputEmail1">User</label>
                <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">-->
                <users></users>


            </div>

            <div class="form-group">
                <label for="newTask">Task Name</label>
                <input class="form-control" type="text" v-model="newTask" id="newTask" @keyup.enter="addTask">
            </div>

            <button id="add" :disabled="creating" @click="addTask">
                <i class="fa fa-refresh fa-spin fa-lg" v-if="creating"></i>
                Afegir Tasca
            </button>

            <h2>Filtres</h2>
            <ul>
                <li @click="show('all')" :class="{active: this.filter =='all'}">All</li>
                <li @click="show('completed')" :class="{active: this.filter =='completed'}">Completed</li>
                <li @click="show('pending') " :class="{active: this.filter =='pending'}">Pending</li>
            </ul>

            <h2>Tasques pendents: </h2>

            <ul>
                {{this.pendingTaskCounter}}
            </ul>

        </div>

        <p slot="Footer">Footer</p>
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
                newTask: '',
                tasks: [],
                creating: false,
                updating: false,
                taskBeingDeleted: null,
                modifyTask: ''
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
            show(filter) {
                this.filter = filter
            },
            addTask() {
                this.creating = true;
                //this.newTask=''
                let url = '/api/tasks'
                axios.post(url, {name: this.newTask }).then((response) =>  {
                    this.tasks.push({ name : this.newTask, completed : false})
                    this.newTask=''

                }).catch((error) => {
                    flash(error.message)
                }).then(()=>{
                    this.$emit('loading',false)
                    this.creating = false

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
