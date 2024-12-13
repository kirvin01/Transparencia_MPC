import { createApp } from 'vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import axios from 'axios';

const app = createApp({
    data() {
        return {
            documentos: [], // Almacena la lista de documentos
            tiposDocumentos: [], // Almacena los tipos de documentos
            filtros: {
                tipo_documento: "",
                numero: "",
                anio: "",
                sumilla: "",
            }, // Filtros del formulario
        };
    },
    methods: {
        // Cargar documentos según filtros
        searchDocumentos() {
            console.log("Enviando filtros:", this.filtros); // Verificar datos enviados
            axios.get('/landing/search-documentos', { params: this.filtros })
                .then(response => {
                    console.log("Documentos encontrados:", response.data); // Verificar respuesta
                    this.documentos = response.data.data; // Asignar los datos paginados
                })
                .catch(error => {
                    console.error("Error al buscar documentos:", error.response?.data || error.message);
                    alert("Ocurrió un error al realizar la búsqueda. Inténtalo nuevamente.");
                });
        },
        // Cargar tipos de documentos desde la API
        fetchTiposDocumentos() {
            axios.get('/landing/tipos-documentos')
                .then(response => {
                 //   console.log("Tipos de documentos cargados:", response.data); // Verificar datos
                    this.tiposDocumentos = response.data;
                })
                .catch(error => {
                    console.error("Error al cargar tipos de documentos:", error.response?.data || error.message);
                });
        },
        // Cargar documentos al inicio
        fetchDocumentos() {
            axios.get('/landing/documentos')
                .then(response => {
                    //console.log("Documentos iniciales cargados:", response.data); // Verificar datos
                    //this.documentos = response.data.data;
                    this.documentos = response.data.data.map(documento => {
                        // Formatear la fecha de cada documento
                        return {
                            ...documento,
                            fechaFormateada: this.formatFecha(documento.fecha)
                        };
                        
                    });
                })
                .catch(error => {
                    console.error("Error al cargar documentos iniciales:", error.response?.data || error.message);
                });
        },
        formatFecha(fecha) {
            // Usando Intl.DateTimeFormat para formatear la fecha en español
            const opciones = { day: 'numeric', month: 'long', year: 'numeric' };
            return new Intl.DateTimeFormat('es-ES', opciones).format(new Date(fecha));
           
        }
    },
    mounted() {
        // Inicializar datos
        this.fetchTiposDocumentos();
        this.fetchDocumentos();
    },
   
});

app.mount('#app');
