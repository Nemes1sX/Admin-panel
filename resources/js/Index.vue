<template>
    <div id="main">
        <header id="header">
            <h1 style="text-align: center;">
                Laravel Vue SPA
            </h1>
            <navMenu></navMenu>
        </header>
        <div id="content">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
  import navMenu from './components/Menu.vue'
  export default {
    data() {
      return {
        //
      }
    },
    components: {
        navMenu//
    }
  }
</script>
