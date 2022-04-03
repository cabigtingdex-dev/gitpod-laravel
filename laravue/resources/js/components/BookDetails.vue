<template>
  <div class="book-details div-window">
    <div v-if="selectedBook">
        <table class="limit-width">
          <tr>
            <th colspan="2" class="book-title">{{ selectedBook.title }}</th>
          </tr>
          <tr>
            <td>Author:</td>
            <td>{{ selectedBook.author }}</td>
          </tr>
          <tr>
            <td>Category:</td>
            <td>{{ selectedBook.category }}</td>
          </tr>
          <tr>
            <td>Description:</td>
            <td>{{ selectedBook.description }}</td>
          </tr>
          <tr>
            <td>Publishing House:</td>
            <td>{{ selectedBook.publishing_house }}</td>
          </tr>
          <tr>
            <td>Publishing Date:</td>
            <td>{{ selectedBook.publishing_date }}</td>
          </tr>
          <tr>
            <td>Entry created at:</td>
            <td>{{ selectedBook.created_at }}</td>
          </tr>
          <tr>
            <td>Entry last modified at:</td>
            <td>{{ selectedBook.updated_at }}</td>
          </tr>
        </table>
    </div>
    <div v-else>
        <table class="limit-width">
          <tr>
            <th colspan="2" class="book-title">Book Details</th>
          </tr>
          <tr>
            <td colspan="2"> 
              <slot name="loadingmessage"> 
                
              </slot> 
            </td>
          </tr>
        </table>
    </div>
  </div>
</template>

<script>

export default {
    props: [ 'selectedBook' ],
    setup(props){

    }
}
</script>

<style>
  .limit-width{
    width: 300px;
  }
  .book-title{
    font-size: 1.3rem;
  }
  th, td{
    text-align: center;
    padding-bottom: 10px;
  }
</style>