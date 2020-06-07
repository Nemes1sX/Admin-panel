<template>
<div>
    <h3>User list</h3>
    <div class="alert alert-danger" v-if="has_error">
        <p>Error, you don't have access to user list.</p>
    </div>
    <table class="table">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>    
            <th scope="col">Actions</th>
        </tr>
        <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;">
            <th scope="row">{{ user.id }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>  
              <div class="btn-group" role="group">
                  <router-link :to="{name: 'edit', params: { id: user.id }}" class="btn btn-primary">Edit
                  </router-link>
                  <button class="btn btn-danger" @click="deleteUser(user.id)">Delete</button>
              </div>
            </td>
        </tr>
    </table>
</div>
</template>
<script>
  export default {
    data() {
      return {
        has_error: false,
        users: null
      }
    },
    mounted() {
      this.getUsers()
    },
    methods: {
      getUsers() {
        this.$http({
          url: `users`,
          method: 'GET'
        })
            .then((res) => {
              this.users = res.data.users
            }, () => {
              this.has_error = true
            })
      },
      deleteUser(id) {
                this.axios
                    .delete(`http://127.0.0.1:8000/api/auth/users/delete/${id}`)
                    .then(response => {
                        let i = this.users.map(item => item.id).indexOf(id); // find index of your object
                        this.users.splice(i, 1)
                    });
            }
    }
  }
</script>