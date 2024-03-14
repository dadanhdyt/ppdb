import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';


// Vuetify
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    aliases : {
        Btn : components.VBtn,
        VNumberField : components.VTextField
    },
    defaults : {
        VSelect : {
            variant : 'outlined',
            color:'primary',
            density:'compact',
        },
        VTextField:{
            variant : 'outlined',
            color:'primary',
            density:'compact'
        },
        Btn : {
            variant : 'elevated',
            color : 'primary',
        },
        VNumberField : {
            color:'primary',
            density:'compact',
            type : 'number',
            variant : 'outlined',
        },
        VTelpField : {
            color:'primary',
            density:'compact',
            type : 'telp',
            variant : 'outlined',
        },

    },
  components,
  directives
})



createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
