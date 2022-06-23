@extends('layouts.master') 
@section('titulo', 'agregarAutor')
@section('contenido')


<!-- INICIA VUE -->
<div id="autor">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-warning">
				<div class="card text-white bg-dark mb-1">
					<div class="card-header">
						<h3>AUTORES
						<span class="btn btn-success" @click="mostrarModal()">
							<i class="fas fa-plus-circle"></i>
						</span>
						</h3>
						<div class="col-md-6" >
							<input type="text" placeholder="Buscar autores" class="form-control" v-model="buscar">
						</div>
					</div>
				</div>
				<div class="card-body table-responsive p-0" style="height: 500px;">					
			<!-- INICIO DE LA TABLA -->
			<table class="table table-head-fixed text-nowrap">
				<thead>
					<th style="background: #C69C00">ID AUTOR</th>
					<th style="background: #C69C00">NOMBRE</th>
					<th style="background: #C69C00">APELLIDO P.</th>
          <th style="background: #C69C00">APELLIDO M.</th>
          <th style="background: #C69C00">PAIS</th>
					<th style="background: #C69C00">NACIMIENTO</th>
					<th style="background: #C69C00">DEFUNCIÓN</th>
          <th style="background: #C69C00">ESTADO</th>
          <th style="background: #C69C00">ACCIONES</th>
				</thead>

				<tbody>
					<tr v-for="autor in filtroAutores">
						<td>@{{autor.id_autor}}</td>
						<td>@{{autor.nombre}}</td>
						<td>@{{autor.apellido_p}}</td>
            <td>@{{autor.apellido_m}}</td>
            <td>@{{autor.pais}}</td>
            <td>@{{autor.anio_nacimiento}}</td>
            <td>@{{autor.anio_defuncion}}</td>
            <td>@{{autor.estado}}</td>

						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-info" @click="editandoAutor(autor.id_autor)">
									<i class="fas fa-edit"></i>
								</button>
		                        <button type="button" class="btn btn-danger" @click="eliminarAutor(autor.id_autor)">
		                        	<i class="fas fa-trash-alt"></i>
		                        </button>
		                    </div>    
						</td>
					</tr>
				</tbody>
			</table>
			<!-- FIN DE LA TABLA -->
				</div>
			</div>
		</div>
	</div>
	
			<!-- INICIA VENTANA Modal -->
		<div class="modal fade" id="modalAutor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">AGREGANDO AUTOR</h5>
		        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">EDITANDO DATOS DEL AUTOR</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        
		      	<h6>NOMBRE DEL AUTOR</h6>
		      	<input type="text" class="form-control" placeholder="Nombre del autor" v-model="nombre"><br>
		      	<h6>APELLIDO PATERNO</h6>
		      	<input type="text" class="form-control" placeholder="Apellido paterno" v-model="apellido_p"><br>
		      	<h6>APELLIDO MATERNO</h6>
		      	<input type="text" class="form-control" placeholder="Apellido materno" v-model="apellido_m"><br>
            <h6>PAIS</h6>
		      	<input type="text" class="form-control" placeholder="Pais" v-model="pais"><br>
            <h6>AÑO DE NACIMIENTO</h6>
		      	<input type="text" class="form-control" placeholder="Año de nacimiento" v-model="anio_nacimiento"><br>
            <h6>AÑO DE DEFUNCIÓN</h6>
		      	<input type="text" class="form-control" placeholder="Año de defuncion" v-model="anio_defuncion"><br>



		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		        <button type="button" class="btn btn-success" @click="guardarAutor" v-if="agregando==true">Guardar</button>
		        <button type="button" class="btn btn-info" @click="actualizarAutor()" v-if="agregando==false">Actualizar</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- TERMINA VENTANA MODAL -->
</div>
<!-- TERMINA VUE -->
@endsection

@push('scripts')

    <script type="text/javascript" src="js/vue-resource.js"></script>
		<script type="text/javascript" src="js/apis/apiAutores.js"></script>
	
@endpush