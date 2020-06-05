<template>
    <div>
        <h3 class="text-center">Add Task</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addTask">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="task.name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" v-model="task.description"></textarea>
                    </div>
                     <div class="form-group">
                        <label>Task date</label>
                        <input type="text" class="form-control" v-model="task.date">
                    </div>
                    <div class="form-group">
                        <label>Assigned user</label>
                        <select class="form-control" v-model="task.user_id">
                            <option v-for="user in users"  v-bind:value="user.id">{{ user.name }}</option>
                        </select>
                    </div>    
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                task: {},
                users: {}
            }
        },
        created(){
            this.axios
                .get('http://127.0.0.1:8000/api/auth/users')
                .then(response =>{
                    this.users = response.data;
                });

        },
        methods: {
            addTask() {

                this.axios
                    .post('http://127.0.0.0.1:8000/api/task/add', this.book)
                    .then(response => (
                        this.$router.push({name: 'home'})
                        // console.log(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>