<template>
    <div class="form-list book-add-batch-form">
        <table class="full-width">
            <tr> 
                <td colspan="7"> <h2> Add Books </h2> </td>
            </tr>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Description</th>
                <th>Publishing house</th>
                <th>Publishing date</th>
            </tr>
            <tr v-for="form in formList" :key="formList.indexOf(form)">
                <td><input type="text" name="title" required v-model="formList[formList.indexOf(form)].title"></td>
                <td><input type="text" name="author" required v-model="formList[formList.indexOf(form)].author"></td>
                <td><input type="text" name="category" required v-model="formList[formList.indexOf(form)].category"></td>
                <td><input type="text" name="description" required v-model="formList[formList.indexOf(form)].description"></td>
                <td><input type="text" name="publishing_house" required v-model="formList[formList.indexOf(form)].publishing_house"></td>
                <td><input type="date" name="publishing_date" required v-model="formList[formList.indexOf(form)].publishing_date"></td>
                <td><button @click="removeEntry(formList.indexOf(form))"> Delete</button> </td>
            </tr>
        </table>
        <div class="batch-add-bottom">
            <router-link :to=" { name:'books' } " class="return-book-view"> <button class="batch-add-bottom-btn"> Return to book views </button> </router-link>
            <a> <button @click="addEntry" class="batch-add-bottom-btn"> Add Entry </button> </a>
            <a> <button @click="batchStore" class="batch-add-bottom-btn"> Add Books to Database </button> </a>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from 'vue'
import useBooks from '../../composables/useBooks'
import { useRouter } from 'vue-router'

export default {
    setup(){
        const { batchStoreBooks } = useBooks()

        const router = useRouter()
        
        const formList = ref([
            reactive({
                title: '', 
                author: '',
                category: '', 
                description: '', 
                publishing_house: '', 
                publishing_date: '2021-01-01', 
            }),
            reactive({
                title: '', 
                author: '',
                category: '', 
                description: '', 
                publishing_house: '', 
                publishing_date: '2021-01-01', 
            }),
            reactive({
                title: '', 
                author: '',
                category: '', 
                description: '', 
                publishing_house: '', 
                publishing_date: '2021-01-01', 
            }),
        ])

        const addEntry = () => {
            formList.value.push(reactive({
                title: '', 
                author: '',
                category: '', 
                description: '', 
                publishing_house: '', 
                publishing_date: '2021-01-01', 
            }))
        }

        const removeEntry = (index) => {
            if (formList.value.length > 1){
                formList.value.splice(index, 1)
            }
        }

        const batchStore = async () => {
            let data = getData()
            if(data){
                await batchStoreBooks(data)
                alert("Books Added!")
                router.push({ name:'books'})
            }
        }

        const getData = () => {
            let data = []
            for (let form of formList.value) {
                for(let key in form){
                    // Make sure all fields are filled
                    if(form[key].trim().length === 0){ 
                        alert("Some fields are not filled!")
                        return false 
                    }
                }
                data.push(form)
            }
            return data
        }

        return { formList, addEntry, removeEntry, batchStore }
    }
}
</script>

<style>
    .book-add-batch-form{
        display: flex;
        flex-direction: column;
        background: var(--div-color);
        border-radius: 10px;
        margin: 1.2rem;
    }
    .full-width{
        width: 100%;
    }
    .batch-add-bottom{
        display: flex;
        justify-content: center;
        padding: 10px 0;
        width: 100%
    }
    .batch-add-bottom-btn{
        color: black;
        font-weight: bold;
        background: var(--process-button);
        border-radius: 10px;
        text-transform: capitalize;
        padding: 15px 10px;
        margin: 0 10px;
    }
    tr{
        border-bottom: 1px solid black;
    }
</style>