<template>
    <div class="book-list div-window">
        <ul class="book-list-top">
            <li class="div-title">
                <h2> Books </h2>
            </li>
            <li>
                <button class="add-book-btn v-center"> Add a Book </button>
            </li>
        </ul>
        <ul class="book-list-container">
            <li @click="selectBook(book.id)" v-for="book in books" :key="book.id" class="book">
                <h3> {{ book.title }} </h3>
                <p> {{ book.author }} </p>
            </li>
        </ul>
    </div>
</template>

<script>


export default {
    props: [ 'books' ],
    emits: [ 'bookClick' ],
    setup(props, { emit }){
        const selectBook = (id) => {
            emit('bookClick', id)
        }

        return { selectBook }
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
        background: greenyellow;
    }
</style>