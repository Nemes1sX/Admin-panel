<template>
    <div>
        <h3 class="text-center">Edit Task</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateBook">
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="task.name" readonly>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" v-model="task.description" readonly></textarea>
                    </div>
                     <div class="form-group">
                        <label>Task date</label>
                        <input type="text" class="form-control" v-model="task.taskdate" readonly>
                    </div>
                        <div class="form-group">
                        <select class="form-control" v-model="task.status">
                           <option value="to-do">To-do</option>
                           <option value="in progress">In progress</option>
                           <option value="done">Done</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" v-model="task.user.id" readonly>
                            <option v-for="user in users" :key="user_id">{{ user.name }}</option>
                        </select>
                    </div>  
                    <button type="submit" class="btn btn-primary">Update Task</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                task: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/task/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.task = response.data;
                    this.task.taskdate = new (Date) this.task.taskdate;
                    // console.log(response.data);
                });
        },
        methods: {
            updateBook() {
                this.axios
                    .post(`http://localhost:8000/api/task/update/${this.$route.params.id}`, this.book)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }