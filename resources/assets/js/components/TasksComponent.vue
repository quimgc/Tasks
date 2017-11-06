<template>
    <div v-cloak>

            <ul>
            <li v-for="task in filteredTasks" v-bind:class="{completed : isCompleted(task) }"
                @dblclick="editTask(task)">

                <input type="text" v-if="editedTask==task"
                       v-model="modifyTask"
                       @keydown.enter="updateTask()"
                       @keyup.esc="cancelEdit()"
                       @keyup.enter="doneEdit()">


                <div v-else>

                    {{task.name}}

                    <i class="fa fa-pencil" aria-hidden="true" @click="updateTask(task)"></i>
                    <i class="fa fa-refresh fa-spin fa-lg" v-if="task.id === taskBeingDeleted"></i>
                    <i class="fa fa-times" v-else aria-hidden="true" @click="deleteTask(task)"></i>

                </div>

            </li>
            </ul>
            Nova tasca a afegir: <input type="text" v-model="newTask" id="newTask" @keyup.enter="addTask">
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
        data() {
            return {
                editedTask: null,
                filter: 'all',
                newTask: '',
                tasks: [],
                creating: false,
                taskBeingDeleted: null
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

                let url = '/api/tasks'+ task.id;
                axios.delete(url).then((response)=>({


                    })

                ).catch((error)=>{


                }).then(

                );



                this.tasks.splice( this.tasks.indexOf(task) , 1 )
            },
            updateTask(task){
                this.editedTask = task
            }
        },
        mounted() {
//        this.tasks = JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY) || '[]')
            console.log(this.tasks)

            // TODO Connectat a Internet i agafam la llista de tasques
//        this.tasks = ???

            // HTTP CLIENT
            let url = '/api/tasks'

            // PROMISES

            this.$emit('loading',true)
            axios.get(url).then(wait(5000)).then((response) =>  {
                this.tasks = response.data;

            }).catch((error) => {
                 flash(error.message)
            }).then(()=>{
                this.$emit('loading',false)

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
