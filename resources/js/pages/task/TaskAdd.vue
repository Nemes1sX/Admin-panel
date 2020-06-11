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
                        <date-picker v-model="task.taskdate" type="datetime" format="YYYY-MM-DD HH:mm"></date-picker>
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
   import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    export default {
      
       components: { DatePicker },
        data() {
            return {
                task: { status: "New"},
                users: {}
            }
        },
        mounted(){
           
            this.getUsers()
        },
        methods: {
            addTask() {
                console.log(this.task)
                this.axios
                    .post('http://localhost:8000/api/tasks/add', this.task) // o parodyk api?
                    .then(response => { //itariu klaida padares esu, kaip ir itariau, bet vistiek tas pats
                         this.$router.push({name: 'home'})
                        console.log(response.data)
                    })
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            getUsers(){
                 this.axios
                .get('http://127.0.0.1:8000/api/auth/users')
                .then(response =>{
                    console.log(response.data);
                    this.users = response.data.users;
                });
               /*  this.$http({
          url: `users`,
          method: 'GET'
        })
            .then((res) => {
              this.users = res.data.users
            }, () => {
              this.has_error = true
            })*/
            }
        }
    }
</script>