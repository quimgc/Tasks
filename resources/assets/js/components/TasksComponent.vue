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
//TODO falta el import
    import { wait }

    export default {
        data() {
            return {
                editedTask: null,
                filter: 'all',
                newTask: '',
                tasks: []
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
                console.log('addTask')
                this.tasks.push({ name : this.newTask, completed : false})
                console.log('3')
                this.newTask=''
            },
            isCompleted(task) {
                return task.completed
            },
            deleteTask(task) {
                this.tasks.splice( this.tasks.indexOf(task) , 1 )
            },
            updateTask(task){
                console.log('Ok ja editare');
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
            //Promises
            var component = this


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
