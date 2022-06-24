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
        id_autor:0,
        error:0,
        arrayError:[]

    },

    // Al crearse la pagina 
    created: function() {
        this.obtenerAutores();
 
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

        validarInputs(){

            this.error=0;
            this.arrayError=[];

            if (!this.nombre) this.arrayError.push('El nombre es requerido');
            if (this.nombre.length > 30) this.arrayError.push('El nombre tiene un limite de 60 letras');
            if (!this.apellido_p) this.arrayError.push('El apellido paterno es requerido');
            if (this.apellido_p.length > 30) this.arrayError.push('El apellido paterno tiene un limite de 30 letras');
            if (!this.apellido_m) this.arrayError.push('El apellido materno es requerido');
            if (this.apellido_m.length > 30) this.arrayError.push('El apellido materno tiene un limite de 30 letras');
            if (!this.pais) this.arrayError.push('El pais es requerido');
            if (this.pais.length > 20) this.arrayError.push('El pais tiene un limite de 20 letras');
            if (!this.anio_nacimiento) this.arrayError.push('El  anio_nacimiento es requerido');
            if (this.anio_nacimiento.length > 11) this.arrayError.push('La fecha de nacimiento tiene un limite de 11 digitos');
            
            //if (this.anio_defuncion.length > 11) this.arrayError.push('La fecha de defuncion tiene un limite de 11 digitos');

            //compruebo si el mensaje tiene algun error para convertir a la variabe  en 1
            if(this.arrayError.length) this.error=1;
                //retorno el rror 
            return this.error;
            
        },

        guardarAutor: function() {

            if (this.validarInputs()) {
                
                for (var i =0; i < this.arrayError.length; i++) {

                    toastr.error(this.arrayError[i],'Verefica tus campos',{

                         
                    });
                }

                return;
            }

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
        editarAutor: function(data=[]) {
            this.agregando = false;
            this.id_autor=data['id_autor'];
            this.nombre=data['nombre'];
            this.apellido_p=data['apellido_p'];
            this.apellido_m=data['apellido_m'];
            this.pais=data['pais'];
            this.anio_nacimiento=data['anio_nacimiento'];
            this.anio_defuncion=data['anio_defuncion'];
            $('#modalAutor').modal('show');
                
        },

        actualizarAutor: function(){
                
                if (this.validarInputs()) {
                    
                    for (var i =0; i < this.arrayError.length; i++) {

                        toastr.error(this.arrayError[i],'Verefica tus campos');
                    }

                    return;
                }

                //creo un array que contendra los datos
        	    let AutorUpdate = {
        		    'nombre':this.nombre,
        		    'apellido_p':this.apellido_p,
        		    'apellido_m':this.apellido_m,
        		    'pais':this.pais,
        		    'anio_defuncion':this.anio_defuncion,
        		    'anio_nacimiento':this.anio_nacimiento
        	    };


                this.$http.patch(apiAutores + '/' + this.id_autor, AutorUpdate).then(function(){
                    //dejo vacio los campos
                    this.nombre="";
                    this.apellido_p="";
                    this.apellido_m="";
                    this.pais="";
                    this.anio_nacimiento="";
                    this.anio_defuncion="";
                    //oculto el modal
                    $('#modalAutor').modal('hide');
                    //refreco la tabla metodo index
                    this.obtenerAutores();
                });
        

        },

        softdeleteAutor: function(id){
           
        
                let url = 'desactivar/estado';
                

                Swal.fire({
                title: '¿Esta seguro de dar de baja al autor?',
                text: "No podra restablecerlo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
         
                    this.$http.put(url,{'id_autor':id,}).then(function(){
                    //sucede el cambio y actualiza la tabla
                    this.obtenerAutores();
                    });                    
                    
                    }
                });

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