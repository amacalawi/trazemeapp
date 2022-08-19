import Vue from 'vue';
import Auth from './Auth.js';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Dashboard from './components/Dashboard.vue';
import Scanner from './components/Scanner.vue';
import Hdf from './components/Hdf.vue';
import Settings from './components/Settings.vue';

const routes = [
    {
        path: '/login',
        component: Login,
        name: "Login"
    },
    {
        path: '/',
        component: Login,
        name: "HomeLogin"
    },
    {
        path: '/register',
        component: Register,
        name: "Register"
    },
    {
        path: '/dashboard',
        component: Dashboard,
        name: "Dashboard",
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/scanner',
        component: Scanner,
        name: "Scanner",
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/hdf',
        component: Hdf,
        name: "Hdf",
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/settings',
        component: Settings,
        name: "Settings",
        meta: {
            requiresAuth: true
        }
    }
];

 const router = new VueRouter({
     mode: 'history',
     routes: routes
 });

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth) ) {
        if (Auth.check()) {
            next();
            return;
        } else {
            router.push('/login');
        }
    } else {
        next();
    }
});

export default router;