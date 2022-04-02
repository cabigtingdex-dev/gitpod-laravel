<template>
  <div class="backdrop">
        <div class="book-add-modal">
            <h2> Book Update Form </h2>
            <form @submit.prevent="handleSubmit" action="post" class="book-form" id="bookform">
                <label> Title: </label>
                <input type="text" name="title" required v-model="title">
                <label> Author: </label>
                <input type="text" name="author" required v-model="author">
                <label> Category: </label>
                <input type="text" name="category" required v-model="category">
                <label> Description: </label>
                <input type="text" name="description" required v-model="description">
                <label> Publishing House: </label>
                <input type="text" name="publishing_house" required v-model="publishing_house">
                <label> Publishing Date: </label>
                <input type="date" name="publishing_date" required v-model="publishing_date">
                <div class="book-form-btn-wrapper">
                    <input type="submit" value="Update book">
                    <input @click="closeModal" type="button" value="Cancel">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { toRefs, reactive } from 'vue'

export default {
    props: [ 'selectedBook' ],
    emits: [ 'closeBookUpdateForm', 'submitted' ],
    setup(props,{ emit }){
        const formData = reactive
        ({
            title: props.selectedBook.title ,
            author: props.selectedBook.author,
            category: props.selectedBook.category,
            description: props.selectedBook.description,
            publishing_house: props.selectedBook.publishing_house,
            publishing_date: props.selectedBook.publishing_date,
        })

        const closeModal = () => {
            emit('closeBookUpdateForm')
        }

        function handleSubmit(){
            emit('submitted', props.selectedBook.id, new FormData(bookform))
        }

        return { ...toRefs(formData), handleSubmit, closeModal }
    }
}
</script>

<style>
    input[value="Update book"]{
        padding: 1.4rem;
        background-color: var(--process-button);
        border-radius: 10px;
    }
</style>