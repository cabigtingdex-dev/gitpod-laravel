<template>
  <div>
    <NavBar/>
    <router-view> </router-view>
  </div>
</template>

<script>
import NavBar from '../js/components/NavBar.vue'

export default {
  components: { NavBar }
  
}
</script>
<style>
  :root {
    --process-button: rgb(45, 175, 45);
    --hot-button: red;
    --div-color: #eee;
    --hovered: greenyellow;
  }
  body{
    background: #bfb;
    margin: 0;
  }
  h2{
    text-align: center;
  }
  .centered{
    margin: 0 auto;
  }
  *{
    font-family: Helvetica;
  }
</style>