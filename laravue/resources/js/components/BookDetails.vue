<template>
  <div class="book-details div-window">
    <slot> </slot>
    <div v-if="selectedBook">
        <h2> {{ selectedBook.title }} </h2>
        <p> Author: {{ selectedBook.author }}</p>
        <p> Category: {{ selectedBook.category }}</p>
        <p> Description: {{ selectedBook.description }}</p>
        <p> Publishing House: {{ selectedBook.publishing_house }}</p>
        <p> Date published: {{ selectedBook.publishing_date }}</p>
        <p> Entry created at: {{ selectedBook.created_at }}</p>
        <p> Entry last updated at: {{ selectedBook.updated_at }}</p>
    </div>
    <div v-else>
        <h2> Book details </h2>
        Loading...
    </div>
  </div>
</template>

<script>
export default {
    props: [ 'selectedBook' ],
    setup(){

    }
}
</script>

<style>

</style>