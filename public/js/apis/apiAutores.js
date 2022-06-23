var apiAutores = "http://localhost/biblioteca/public/apiAutores";
new Vue({
    http: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },
    el: "#autor",
    data: {
        nombre: '',
        apellido_p: '',
        apellido_m: '',
        pais: '',
        anio_nacimiento: '',
        anio_defuncion: '',
        estado: 1,
        agregando: true,
        autores: [],
        buscar: '',


        // cantidad: 0,
        // precio: 1,


    },

    // Al crearse la pagina 
    created: function() {
        this.obtenerAutores();
        // this.obtenerProductos();
        // this.obtenerBebidas();
        // this.obtenerComidas();

    },


    // INICIO DE METHODS
    methods: {
        obtenerAutores: function() {
            this.$http.get(apiAutores).then(function(json) {
                this.autores = json.data;
            }).catch(function(json) {
                console.log(json);
            });
        },



        mostrarModal: function() {
            this.agregando = true;
            this.obtenerAutores();
            this.nombre = '';
            this.apellido_p = '';
            this.apellido_m = '';
            this.pais = '';
            this.anio_nacimiento = '';
            this.anio_defuncion = '';

            $('#modalAutor').modal('show');
        },

        guardarAutor: function() {
            var autor = {
                nombre: this.nombre,
                apellido_p: this.apellido_p,
                apellido_m: this.apellido_m,
                pais: this.pais,
                anio_nacimiento: this.anio_nacimiento,
                anio_defuncion: this.anio_defuncion

            };
            this.$http.post(apiAutores, autor).then(function(json) {
                this.obtenerAutores();
                this.nombre = '';
                this.apellido_p = '';
                this.apellido_m = '';
                this.pais = '';
                this.anio_nacimiento = '';
                this.anio_defuncion = '';
            }).catch(function(json) {
                console.log(json);
            });

            $('#modalAutor').modal('hide');

            console.log(autor);

        },

    },

    computed: {

        filtroAutores: function() {
            return this.autores.filter((autor) => {
                return autor.nombre.toLowerCase().match(this.buscar.toLowerCase().trim())
            });

        }
    }

});
// FIN DE METHODS