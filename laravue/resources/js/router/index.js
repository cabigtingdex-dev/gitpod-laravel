import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../components/views/HomeView.vue'
import BookView from '../components/views/BookView.vue'
import LoginView from '../components/views/LoginView.vue'
import RegisterView from '../components/views/RegisterView.vue'
import BookBatchAddView from '../components/views/BookBatchAddView.vue'
import BookBatchUpdateView from '../components/views/BookBatchUpdateView.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/books',
        name: 'books',
        component: BookView
    },
    {
        path: '/login',
        name: 'login',
        component: LoginView
    },
    {
        path: '/register',
        name: 'register',
        component: RegisterView
    },
    {
        path: '/books/batch/add',
        name: 'booksAddBatch',
        component: BookBatchAddView
    },
    {
        path: '/books/batch/edit',
        name: 'booksUpdateBatch',
        component: BookBatchUpdateView,
        props: true
    }
]

export default createRouter({
    history: createWebHashHistory(process.env.BASE_URL),
    routes
})