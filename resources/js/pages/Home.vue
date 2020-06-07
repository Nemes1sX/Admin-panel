<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Welcome</div>
            <div class="card-body">
                <h3>
                    Hello, this Laravel Vue SPA panel
                </h3>
                      <div class="btn-group" role="group">
                        <router-link :to="{name: 'login'}" class="btn btn-primary">Login
                        </router-link>
                    </div>
                        <p>Don't have an account</p>
                        <router-link :to="{name: 'register'}" class="btn btn-danger">Register
                        </router-link>   
            </div>
        </div>
    </div>
</template>