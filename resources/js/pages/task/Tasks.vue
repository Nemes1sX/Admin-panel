<template>
    <div>
        <h3 class="text-center">All Tasks</h3><br/>
        <router-link :to="{name: 'task.add'}" class="btn btn-success">Add Task</router-link>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Taskdate</th>
                <th>Status</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

              <tr v-for="task in tasks" :key="task.id">
                <td>{{ task.name }}</td>
                <td>{{ task.description }}</td>
                <td>{{ task.taskdate }}</td>
                <td>{{ task.status }}</td>
               <td>{{ task.user.name }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'task.edit', params: { id: task.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteTask(task.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
 import { mapActions } from 'vuex';
    export default {
        /*data() {
            return {
                tasks: []
            }
        },
       created() {
            this.axios
                .get('http://127.0.0.1:8000/api/tasks')
                .then(response => {
                    this.tasks = response.data.tasks;
                });
        },*/
        props:{
           value: {
                type: Object
            }
        },
        mounted(payload){
            this.$store.dispatch('allTasks', payload)
        },
        computed:{
            tasks(){
                return this.$store.getters.getTasks
            }
        },
        methods: {
            ...mapActions({
                deleteTask: 'deleteTask'
            })
        }
    }
</script>