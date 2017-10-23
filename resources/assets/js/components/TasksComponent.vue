<template>
    <div v-cloak>

    <ul>
     <!--Es al reves que amb un foreach de php -->
         <li v-for="task in filteredTasks" v-bind:class="{completed : isCompleted(task) }" @dblclick="editTask(task)">

                          <input type="text"  v-if="editedTask==task"
                                 v-model="modifyTask"
                                 @keydown.enter="updateTask()"
                                 @keyup.esc="cancelEdit()"
                                 @keyup.enter="doneEdit()">


                          <div v-else>

                              {{task.name}}

                              <i class="fa fa-pencil" aria-hidden="true" @click="updateTask(task)"></i>

                              <i class="fa fa-times" aria-hidden="true" @click="deleteTask(task)"></i>

                          </div>

                      </li>
                  </ul>

                  Nova tasca a afegir: <input type="text" v-model="newTask" id="newTask" @keyup.enter="addTask">
                  <button id="add" @click="addTask"> Afegir Tasca</button>

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

    var filters = {

        all: function (tasks) {
            return tasks
        },
        pending: function (tasks) {

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





    const LOCAL_STORAGE_KEY = "TASKS"

    export default {
        data() {
            return {
                editedTask: '',
                filter: 'all',
                modifyTask: '',
                newTask: '',
                isUpdate : false,
                tasks: JSON.parse(this.dataTasks)
            }

        },
        watch: {
            tasks: function () {

    //            localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(this.tasks))
               // console.log(this.tasks)

            }
        },
        computed: {

            filteredTasks: function () {
                console.log(this.filter)
                return filters[this.filter](this.tasks)
            },
            pendingTaskCounter: function(){
                return filters.pending(this.tasks).length

            }

        },
        props: {
            dataTasks: {
               required: false
            }
        },
        methods: {

            show(filter){
                this.filter = filter
            },

            addTask() {

                this.tasks.push({name : this.newTask, completed : false});
                this.newTask='';

            },
            isCompleted(task) {
                return task.completed;
            },
            deleteTask(task){
                this.tasks.splice(this.tasks.indexOf(task) ,1);


            },


            editTask(task) {
                console.log("editTask");
                console.log(task.name);
                this.editedTask=task;
                this.modifyTask = task.name;


            },

            updateTask(){
                console.log("updateTask");
                console.log(this.editedTask.name);
                this.editedTask.name = this.modifyTask;


            },

            cancelEdit(){
                console.log("cancel");
                this.editedTask = null;

            },
            doneEdit(){
                console.log("done");
                this.modifyTask = '';
                this.editedTask = this.editedTask.name;
            }


        },

        mounted() {

            var component = this

            //this.tasks = JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY) || '[]')
            console.log(component.tasks)

            //TODO connectar-se a internet i agafar la llista de tasques.
            let url = '/api/tasks'


            axios.get(url).then(function (response) {
                //this.tasks = response;
                console.log(response)
                console.log(response.data)
                console.log(response.status)

                component.tasks = response.data;
            }).catch(function (error) {
                flash(error);
            })




            //API HTTP amb JSON <- web service
            //URL GET http://nom_servidor/api/tasks
            //URL POST http://nom_servidor/api/tasks
            //URL EDIT http://nom_servidor/api/tasks
            //URL DELETE http://nom_servidor/api/tasks
            //URL PUT/PATH http://nom_servidor/api/tasks


        }

    }

</script>
