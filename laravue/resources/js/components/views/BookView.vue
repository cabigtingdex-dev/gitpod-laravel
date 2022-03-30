<template>
    <main>
        <div class="upper-main">
            <BookList :books="books" @bookClick="setSelectedBook"/>
            <BookDetails :selectedBook="selectedBook"> </BookDetails>
        </div>
    </main>
</template>

<script>
import BookList from '../BookList.vue'
import BookDetails from '../BookDetails.vue'
import useBooks from '../../composables/useBooks'
import { onMounted, ref } from '@vue/runtime-core'

export default {
    components: { BookList, BookDetails },
    setup(){
        const { books, book, getBooks, getBook } = useBooks()

        const selectedBook = ref(false)

        onMounted(() => {
            getBooks()
        })

        const setSelectedBook = async (id) => {
            selectedBook.value = false
            await getBook(id)
            selectedBook.value = book.value
        }

        return { books, book, selectedBook, setSelectedBook }
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
        flex-grow: 2;
    }
    .div-title{
        flex-grow: 1;
    }
</style>