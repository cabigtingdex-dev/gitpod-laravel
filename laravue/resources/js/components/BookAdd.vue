<template>
  <div class="backdrop" @click.self="closeModal">
        <div class="book-add-modal">
            <h2> Book Add Form </h2>
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
                    <input type="submit" value="Add book">
                    <input @click="closeModal" type="button" value="Cancel">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { toRefs, reactive } from 'vue'

export default {
    emits: [ 'closeBookAddForm', 'submitted' ],
    setup(props,{ emit }){
        const formData = reactive
        ({
            title: 'My Vue Training',
            author: 'Kyle Andrae Mendiola',
            category: 'Web Development',
            description: 'Just a test book',
            publishing_house: 'Bahay_Kyle',
            publishing_date: '2021-01-01',
        })

        const closeModal = () => {
            emit('closeBookAddForm')
        }

        function handleSubmit(){
            emit('submitted', new FormData(bookform))
        }

        return { ...toRefs(formData), handleSubmit, closeModal }
    }
}
</script>

<style>
    .book-add-modal {
        width: 400px;
        padding: 20px;
        margin: 100px auto;
        background: white;
        border-radius: 10px;
    }

    .backdrop {
        top: 0;
        position: fixed;
        background: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
    }
    .book-form{
        display: flex;
        flex-direction: column;
    }
    .book-form > input[type="text"], .book-form > input[type="date"]{
        height: 1.4rem;
        border-radius: 10px;
    }
    .book-form-btn-wrapper{
        display: flex;
        justify-content: space-evenly;
        margin-top: 10px;
    }
    input[value="Add book"]{
        padding: 1.4rem;
        background-color: var(--process-button);
        border-radius: 10px;
    }
    input[value="Cancel"]{
        padding: 1.4rem;
        background-color: var(--hot-button);
        border-radius: 10px;
    }
</style>