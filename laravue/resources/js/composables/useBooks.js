import { ref } from 'vue'
import axios from 'axios'
import { stringify } from 'qs'

const qs = require('qs')


function useBook() {
    
    const books = ref([])
    const book = ref(null)

    const getBooks = async () => {
        try {
          let response = await axios.get("/api/books")
          books.value = response.data.data
        }
        catch (err){
          console.log(err.message)
        }
    }

    const getBook = async (id) => {
        try {
            let response = await axios.get("/api/books/" + id)
            book.value = response.data.data
        }
        catch (err){
            console.log(err.message)
        }
    }

    const insertBook = async (formData) => {
      try{     
          let response = await axios.post("/api/books", formData)
          return response.data.data
      }
      catch(err){
          console.log(err.message)
      }
    }

    const updateBook = async (id, formData) => {
        try {
            let data = await axios.put("/api/books/" + id, { 
                title: formData.get('title'),
                author: formData.get('author'),
                category: formData.get('category'),
                description: formData.get('description'),
                publishing_house: formData.get('publishing_house'),
                publishing_date: formData.get('publishing_date'),
             })
            console.log(data.data)
        } 
        catch (err) {
            console.log(err.message)
        }
    }

    const deleteBook = async (id) => {
      try {
          await axios.delete("/api/books/" + id)
          getBooks()
      }
      catch (err){
          console.log(err)
      }
    }
    const batchDeleteBooks = async (bookIds) => {
        try{
            bookIds = [...bookIds]
            await axios.delete('/api/books/batch', { data: { bookIds } })
            getBooks()
        }
        catch(err){
            console.log(err)
        }
    }
    const batchUpdateBooks = async (bookIds, booksData) => {
        booksData = JSON.parse(JSON.stringify(booksData))
        try{
            await axios.put('/api/books/batch', { bookIds, booksData })
        }
        catch(err){
            console.log(err.response.data)
        }
    }
    const batchStoreBooks = async (newBooks) => {
        newBooks = JSON.parse(JSON.stringify(newBooks))
        console.log(newBooks)
        try{
            await axios.post('/api/books/batch', { newBooks })
        }
        catch(err){
            console.log(err.response.data)
        }
    }

    return { books, book, getBooks, getBook, insertBook, updateBook, deleteBook, batchUpdateBooks, batchStoreBooks, batchDeleteBooks }
}

export default useBook