import { ref } from 'vue'
import axios from 'axios'

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
          console.log(err)
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

    return { books, book, getBooks, getBook, insertBook, deleteBook }
}

export default useBook