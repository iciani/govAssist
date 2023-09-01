import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import { useApi } from '@/api/useAPI'

//Constants
import DefinesGLOBAL from '@/definesProject'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css'

const govassist = {
	dark: false,
	colors: {
		background: '#F3F4F6',
		surface: '#FFFFFF',
		primary: '#00579B',
		'primary-darken-1': '#FFFFFF',
		secondary: '#CFE8E1',
		'secondary-darken-1': '#018786',
		error: '#B00020',
		info: '#2196F3',
		success: '#4CAF50',
		warning: '#FB8C00',
	},
}

const vuetify = createVuetify({
	components,
	directives,
	icons: {
		defaultSet: 'mdi',
		aliases,
		sets: {
			mdi,
		},
	},

	theme: {
		defaultTheme: 'govassist',
		themes: {
			govassist,
		},
	},
})

const app = createApp(App)

//AXIOS
app.provide('axios', useApi())
app.provide('globals', DefinesGLOBAL)

app.use(createPinia())
app.use(router)
app.use(vuetify).mount('#app')
