import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../vue/auth/Login.vue'
import Register from '../vue/auth/Register.vue'


import Home from '../vue/components/Home.vue'
import ItemMenu from '../vue/components/ItemMenu.vue'


import Dashboard from '../vue/dashboard/Dashboard.vue'
import Category from '../vue/Dashboard/Category.vue'
import SubCategory from '../vue/Dashboard/SubCategory.vue'
import Details from '../vue/Dashboard/Details.vue'

Vue.use(VueRouter)


const routes = [{
        path: '/',
        name: 'Home',
        component: Home,

    },

    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true
        },
        children: [{
                path: '/category',
                name: 'Category',
                component: Category,
                meta: {
                    requiresAuth: true
                }
            },
            {
                path: '/subcategory',
                name: 'SubCategory',
                component: SubCategory,
                meta: {
                    requiresAuth: true
                }
            },
            {
                path: '/details',
                name: 'Details',
                component: Details,
                meta: {
                    requiresAuth: true
                }

            }
        ],
    }, {
        path: '/vejbylogin',
        name: 'Login',
        component: Login,

    },
    {
        path: '/vejbyregister',
        name: 'Register',
        component: Register,

    },

]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})



function loggedIn() {
    return localStorage.getItem('token');


}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!loggedIn()) {
            next({
                path: '/vejbylogin',
                query: {
                    redirect: to.fullPath
                }
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (loggedIn()) { //so if user loggedin true->redirect to dashboard
            next({
                path: '/dashboard',
                query: {
                    redirect: to.fullPath
                }
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})


export default router