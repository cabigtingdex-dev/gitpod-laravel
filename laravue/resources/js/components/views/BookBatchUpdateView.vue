<template>
    <div class="form-list book-add-batch-form">
        <table class="full-width">
            <tr> 
                <td colspan="7"> <h2> Edit Books Information </h2> </td>
            </tr>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Description</th>
                <th>Publishing house</th>
                <th>Publishing date</th>
            </tr>
            <tr v-for="selectedBook in selectedBookList" :key="selectedBook.id">
                <td><input type="text" name="title" required v-model="formDataList[selectedBook.id].title"></td>
                <td><input type="text" name="author" required v-model="formDataList[selectedBook.id].author"></td>
                <td><input type="text" name="category" required v-model="formDataList[selectedBook.id].category"></td>
                <td><input type="text" name="description" required v-model="formDataList[selectedBook.id].description"></td>
                <td><input type="text" name="publishing_house" required v-model="formDataList[selectedBook.id].publishing_house"></td>
                <td><input type="date" name="publishing_date" required v-model="formDataList[selectedBook.id].publishing_date"></td>
                <td><button @click="removeEntry(selectedBookList.indexOf(selectedBook.id))"> Delete </button> </td>
            </tr>
        </table>
        <div class="batch-add-bottom">
            <router-link :to=" { name:'books' } " class="return-book-view"> <button class="batch-add-bottom-btn"> Return to book views </button> </router-link>
            <a> <button @click="batchUpdate" class="batch-add-bottom-btn"> Update Books </button> </a>
        </div>
    </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue'
import useBooks from '../../composables/useBooks'
import { useRouter } from 'vue-router'

export default {
    props: [ 'selectedBooks' ],
    setup(props){
        const { book, getBook, batchUpdateBooks } = useBooks()


        const router = useRouter()
        const selectedBookList = ref([])
        const formDataList = ref({})

        onMounted( async () => {
            let selBks = props.selectedBooks
            for(let bookId of selBks){
                await getBook(bookId)
                selectedBookList.value.push(book.value)
                formDataList.value[bookId] = reactive({
                    title: book.value.title, 
                    author: book.value.author,
                    category: book.value.category, 
                    description: book.value.description, 
                    publishing_house: book.value.publishing_house, 
                    publishing_date: book.value.publishing_date, 
                })
            }
        })

        const batchUpdate = async () => {
            await batchUpdateBooks(getIds(), getData())
            alert("Books updated")
            router.push({ name:'books'})
        }

        const removeEntry = (index) => {
            if (selectedBookList.value.length > 1){
                delete formDataList.value[index]
                selectedBookList.value.splice(index, 1)
            }
        }

        const getIds = () => {
            let ids = []
            for(let book of selectedBookList.value){
                ids.push(book.id)
            }
            return ids
        }
        const getData = () => {
            let data = []
            for (let key in formDataList.value) {
                if (formDataList.value.hasOwnProperty(key)) {
                    data.push(formDataList.value[key])
                }
            }
            return data
        }

        return { selectedBookList, formDataList, removeEntry, batchUpdate }
    }
}
</script>

<style>

</style>