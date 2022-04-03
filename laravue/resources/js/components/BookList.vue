<template>
    <div class="book-list div-window">
        <ul class="book-list-top">
            <li class="div-title">
                <h2> Books </h2>
            </li>
            <li>
                <button @click="showBookAddForm" class="add-book-btn v-center"> Add a Book </button>
                <button class="add-book-btn v-center"> 
                    <router-link :to="{ name: 'booksAddBatch' }"> Add Multiple Books </router-link> 
                </button>
                <button @click="batchDelete" :disabled="!selectedBooks" class="delete-books-btn v-center"> Delete Selected </button>
            </li>
        </ul>
        <ul class="book-list-container" v-if="books">
            <li @click="selectBook(book.id)" 
            v-for="book in books" :key="book.id" 
            class="book" :class="{ selected: selectedBook.id === book.id }">
                <div class="book-lefthand">
                    <input @click="computeSelectedBooks" type="checkbox" name="book" :value="book.id">
                    <h3> {{ book.title }} </h3>
                </div>
                <div class="book-righthand">
                    <p class="book-author"> {{ book.author }} </p>
                    <button @click.stop="showBookUpdateForm(book.id)" class="book-edit-btn"> Edit </button>
                    <button @click.stop="deleteBook(book.id)" class="book-delete-btn"> Delete </button>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { ref } from '@vue/runtime-core'

export default {
    props: [ 'books', 'selectedBook' ],
    emits: [ 'bookClick', 'showBookAddForm', 'showBookUpdateForm', 'bookUpdate', 'bookDelete', 'batchDeleteClicked' ],
    setup(props, { emit }){

        const selectedBooks = ref([])
        
        const computeSelectedBooks = () => {
            let checkboxes = [...document.querySelectorAll("input[name='book']:checked")]
            let cbvalues = []
            for(let cb of checkboxes) { cbvalues.push(cb.value) }

            selectedBooks.value = cbvalues
        }
        const selectBook = (id) => {
            if(props.selectedBook.id !== id){
                emit('bookClick', id)
            }
        }
        const showBookAddForm = () => {
            emit('showBookAddForm')
        }
        const deleteBook = (id) => {
            if(confirm("Are you sure?")){
                emit('bookDelete', id)
            }
        }
        const batchDelete = () => {
            emit("batchDeleteClicked", selectedBooks.value)
        }
        const showBookUpdateForm = (id) => {
            emit('showBookUpdateForm', id)
        }
        const updateBook = (id) => {
             emit('bookUpdate', id)   
        }

        return { 
            selectBook, 
            selectedBooks, 
            computeSelectedBooks, 
            batchDelete, 
            showBookAddForm, 
            showBookUpdateForm, 
            updateBook, 
            deleteBook }
    }
}
</script>

<style>  
    .book-list{
        flex-grow: 1;
    }
    .book-list-top{
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 0 5px;
        border-bottom: 2px solid black;
    }
    .book-list-top.li{
        display: flex;
        align-content: center;
        padding: 0;
    }
    .add-book-btn{
        background: var(--process-button);
        padding: 1.3rem;
        border-radius: 10px;
        font-weight: bold;
        margin: 0 5px;
    }
    .delete-books-btn{
        background: var(--hot-button);
        padding: 1.3rem;
        border-radius: 10px;
        font-weight: bold;
        margin: 0 5px;
    }
    .book-list-container{
        display: flex;
        flex-direction: column;
    }
    .book {
        display: flex;
        background: white;
        justify-content: space-between;
        margin: 5px;
        padding: 0 5px;
    }
    .book:hover{
        background: var(--hovered);
    }
    .selected{
        background: var(--hovered);
        outline: 2px solid black;
    }
    .book-righthand{
        display: flex;
        align-items: center;
    }
    .book-lefthand{
        display: flex;
        align-items: center;
    }
    .book-righthand > *{
        margin: 0 5px;
    }
    .book-author{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 200px;
    }
    .book-edit-btn{
        background-color: var(--process-button);
        border-radius: 10px;
        height: 1.5rem;
    }
    .book-delete-btn{
        background-color: var(--hot-button);
        border-radius: 10px;
        height: 1.5rem;
    }
</style>