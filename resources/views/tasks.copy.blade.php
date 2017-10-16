@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Tasks
@endsection


@section('main-content')

    <style>

        [v-cloak] { display: none; }
        li.completed {
            text-decoration: line-through;
        }

        li.active {
            background-color: #cdffe4;
        }

    </style>

    <div id="root" v-cloak>

        <ul>
            <!--Es al reves que amb un foreach de php -->
            <li v-for="task in filteredTasks" v-bind:class="{completed : isCompleted(task) }" @dblclick="editTask(task)">

                <input type="text"  v-if="editedTask==task"
                       v-model="modifyTask"
                       @keydown.enter="updateTask()"
                       @keyup.esc="cancelEdit()"
                       @keyup.enter="doneEdit()">


                <div v-else>

                    @{{task.name}}

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
            @{{this.pendingTaskCounter}}
        </ul>

    </div>
    <script src="https://unpkg.com/vue"></script>


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

        let vm = new Vue({

            el: '#root',
            data: {
                editedTask: '',
                filter: 'all',
                modifyTask: '',
                newTask: '',
                isUpdate : false,
                tasks: []

            },

            watch: {
                tasks: function () {

                    localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(this.tasks))

                }
            },



            computed: {

                filteredTasks: function () {

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
//
//            showCompleted(){
//                this.filter = 'completed'
//
//            },
//            showPending(){
//                this.filter = 'pending'
//
//            },

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

                this.tasks = JSON.parse(localStorage.getItem(LOCAL_STORAGE_KEY) || '[]')
                //this.tasks = localStorage.getItem()
                //TODO obtenir les tasques de la localStorage.
//            this.newTask = localStorage.setItem('NEW_TASK', 'Nova tasca')
//            this.newTask = localStorage.getItem('NEW_TASK')

            }

        })

    </script>

@endsection
