<script setup>
import { RouterLink } from 'vue-router';
</script>
<template>
    <div class="flex">
      <h1>Page Not Found</h1>
      <br>
      <RouterLink to="/" class="item">Back to Home</RouterLink>
    </div>
</template>
<style lang="css">

  .flex{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .flex h1{
    font-size: 40px;
    margin-bottom: 10px;
  }

  .item{
    font-size: 22px;
    padding: 10px 30px;
    background-color: #fff;
    color: #4d3dc7;
    text-decoration: none;
  }

  .item:hover{
    background-color: #090430;
    color: #fff;
    transition: .3s ease-in-out;
  }

</style>