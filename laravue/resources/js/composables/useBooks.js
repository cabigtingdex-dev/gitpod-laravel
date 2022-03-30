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

    return { books, book, getBooks, getBook}
}

export default useBook