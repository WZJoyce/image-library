require('./bootstrap')

import "tailwindcss/tailwind.css"
import Vue from 'vue'
import VueRouter from "vue-router"


Vue.use(VueRouter)



/**
 * Import and setup Inertia.js
 **/
import { InertiaApp } from '@inertiajs/inertia-vue'
Vue.use(InertiaApp)

let app = document.getElementById('app')

new Vue({
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: (name) => {
                return import(`@/Pages/${name}`).then(module => module.default)
            },
        },
    })
}).$mount(app);

