import { createApp } from 'vue';
// Importar Bootstrap (tanto CSS como JS)
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

const landing = createApp({
    data() {
        return {
            mensaje: "Vue está funcionando correctamente",
        };
    },
});

landing.mount('#app');
