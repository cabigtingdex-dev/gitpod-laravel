<template>
    <main>
        <div class="upper-main">
            <BookList 
            :books="books" 
            :selectedBook="selectedBook" 
            @bookClick="setSelectedBook" 
            @showBookAddForm="toggleBookAddForm" 
            @showBookUpdateForm="toggleBookUpdateForm"  
            @bookDelete="deleteBk"
            @batchDeleteClicked="batchDeleteBks" />

            <BookDetails :selectedBook="selectedBook">
                <template v-slot:loadingmessage> 
                    {{ loadingmessage }} 
                </template>
            </BookDetails>
        </div>
        <div v-if="showBookAddForm">
            <BookAdd @closeBookAddForm="toggleBookAddForm" @submitted="addBook"/>
        </div>
        <div v-if="showBookUpdateForm">
            <BookUpdate :selectedBook="selectedBook" @closeBookUpdateForm="toggleBookUpdateForm" @submitted="updateBk"/>
        </div>
    </main>
</template>

<script>
import BookList from '../BookList.vue'
import BookDetails from '../BookDetails.vue'
import BookAdd from '../BookAdd.vue'
import BookUpdate from '../BookUpdate.vue'
import useBooks from '../../composables/useBooks'
import { onMounted, ref } from '@vue/runtime-core'

export default {
    components: { BookList, BookDetails, BookAdd, BookUpdate },
    setup(){
        const { books, book, getBooks, getBook, insertBook, updateBook, deleteBook, batchDeleteBooks } = useBooks()

        const selectedBook = ref(false)
        const showBookAddForm = ref(false)
        const showBookUpdateForm = ref(false)

        const loadingmessage = ref("No book selected")

        onMounted( async () => {
            await getBooks()
            sortBooks()
        })

        const sortBooks = () => {
            books.value.sort(function(a,b){
                return new Date(b.updated_at) - new Date(a.updated_at);
            })
        }

        const toggleBookAddForm = () => {
            showBookAddForm.value = !showBookAddForm.value
        }

        const toggleBookUpdateForm = async (id) => {
            if (!showBookUpdateForm.value) {
                await getBook(id)
                selectedBook.value = book.value
            }
            showBookUpdateForm.value = !showBookUpdateForm.value
        }

        const setSelectedBook = async (id) => {
            loadingmessage.value = "Loading..."
            selectedBook.value = false
            await getBook(id)
            selectedBook.value = book.value
        }

        const addBook = async (fd) => {
            let res = await insertBook(fd)
            alert("Book added!")
            getBooks()
            setSelectedBook(res.id)
            toggleBookAddForm()
        }

        const updateBk = async (id, formData) => {
            await updateBook(id, formData)
            await getBooks()
            toggleBookUpdateForm()
            setSelectedBook(id)
        }

        const deleteBk = (id) => {
            // Change book detail loading message depending on conditions
            if (selectedBook.value.id === id || selectedBook){ loadingmessage.value = "No book selected" }

            // Removes deleted book from book list
            books.value = books.value.filter((value) => { return value.id !== id } )

            selectedBook.value = false
            deleteBook(id)
        }

        const batchDeleteBks = async (bookIds) => {
            await batchDeleteBooks(bookIds)
            loadingmessage.value = "No book selected"
            selectedBook.value = false
            getBooks()
        }

        return {
            sortBooks,
            books, 
            book, 
            selectedBook, 
            setSelectedBook,
            loadingmessage,
            addBook, 
            updateBk,
            deleteBk,
            batchDeleteBks,
            showBookAddForm,
            showBookUpdateForm,
            toggleBookAddForm,
            toggleBookUpdateForm }
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