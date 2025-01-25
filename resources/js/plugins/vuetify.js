import { createVuetify  } from 'vuetify'
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.min.css'
export default createVuetify({
    theme: {
        themes: {
            light: {
                colors: {
                    accent: '#F7C54A',
                    surface: '#fafafa',
                    primary: '#023459',
                    error: '#c20d0d',
                    success: '#41a748',
                },
            },
        },
    },
    defaults: {
        VCard: {
            rounded: 'lg',
        },

        VTextField: {
            variant: 'outlined',
            density: 'comfortable',
            color: 'primary',
        },

        VTextarea: {
            variant: 'outlined',
            density: 'comfortable',
            color: 'primary',
        },

        VSelect: {
            variant: 'outlined',
            density: 'comfortable',
            color: 'primary',
        },

        VTooltip: {
            location: 'top',
        },

        VBtn: {
            variant: 'flat',
            color: 'primary',
        },
    },
});
