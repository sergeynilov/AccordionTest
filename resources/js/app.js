require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import VueUploadComponent from 'vue-upload-component'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

import mitt from 'mitt';
window.emitter = mitt();

window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: false,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})


import 'tw-elements'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component('file-upload', VueUploadComponent)
            .mixin({ methods: { route } })
            .mount(el);
    },
});


InertiaProgress.init({ color: '#4B5563' });
