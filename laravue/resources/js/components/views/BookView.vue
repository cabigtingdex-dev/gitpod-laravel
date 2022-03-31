<template>
    <main>
        <div class="upper-main">
            <BookList 
            :books="books" 
            :selectedBook="selectedBook" 
            @bookClick="setSelectedBook" 
            @showBookAddForm="toggleBookAddForm" 
            @bookDelete="deleteBk" />

            <BookDetails 
            :selectedBook="selectedBook" />
        </div>
        <div v-if="showBookAddForm">
            <BookAdd @closeBookAddForm="toggleBookAddForm" @submitted="addBook"/>
        </div>
        
    </main>
</template>

<script>
import BookList from '../BookList.vue'
import BookDetails from '../BookDetails.vue'
import BookAdd from '../BookAdd.vue'
import useBooks from '../../composables/useBooks'
import { onMounted, ref } from '@vue/runtime-core'

export default {
    components: { BookList, BookDetails, BookAdd },
    setup(){
        const { books, book, getBooks, getBook, insertBook, deleteBook } = useBooks()

        const selectedBook = ref(false)
        const showBookAddForm = ref(false)

        onMounted(() => {
            getBooks()
        })

        const toggleBookAddForm = () => {
            showBookAddForm.value = !showBookAddForm.value
        }

        const setSelectedBook = async (id) => {
            selectedBook.value = false
            await getBook(id)
            selectedBook.value = book.value
        }

        const addBook = async (fd) => {
            await insertBook(fd)
            alert("Book added!")
            getBooks()
            toggleBookAddForm()
        }
        const deleteBk = async (id) => {
            selectedBook.value = false
            await deleteBook(id)
            alert('Book Deleted')
        }

        return { 
            books, 
            book, 
            selectedBook, 
            setSelectedBook, 
            addBook, 
            deleteBk,
            showBookAddForm, 
            toggleBookAddForm }
    }
}
</script>

<style>
    .upper-main{
        display: flex;
        justify-content: space-between;
    }
    .div-window{
        background: var(--div-color);
        border-radius: 10px;
        margin: 10px;
    }
    .book-details{
        display: flex;
        justify-content: center;
        flex-grow: 2;
    }
    .div-title{
        flex-grow: 1;
    }
</style>