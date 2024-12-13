<!--<div class="bg-light p-4 rounded shadow-sm text-center">
    <form @submit.prevent="searchDocumentos">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 d-flex align-items-center mb-2">
                <label for="tipoDocumento" class="form-label me-2">Tipo de Documento:</label>
                <select class="form-select" id="tipoDocumento" v-model="filtros.tipo_documento">
                    <option value="" class="placeholder">Seleccione Documento</option>
                    <option v-for="tipo in tiposDocumentos" :key="tipo.id" :value="tipo.id">
                        @{{ tipo.titulo }}
                    </option>
                </select>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 d-flex align-items-center mb-2">
                <label for="numero" class="form-label me-2">Nro.</label>
                <input type="text" class="form-control" id="numero" placeholder="Número" v-model="filtros.numero">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 d-flex align-items-center">
                <label for="anio" class="form-label me-2">Año:</label>
                <input type="text" class="form-control" id="anio" placeholder="Año" v-model="filtros.anio">
            </div>
        </div>
        <div class="row col-12 mb-2">
            <div class="d-flex align-items-center mx-4">
                <label for="sumilla" class="form-label mx-3">Sumilla:</label>
                <textarea class="form-control mx-0" id="sumilla" rows="2" placeholder="Buscar por palabras claves"
                    v-model="filtros.sumilla"></textarea>
            </div>
        </div>
        <div class="col-lg-2 mt-4 col-md-12 col-sm-12">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
</div>-->
<div class="bg-light p-4 rounded shadow-sm text-center">
    <form @submit.prevent="searchDocumentos">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 d-flex align-items-center mb-2">
                <label for="tipoDocumento" class="form-label me-2">Tipo de Documento:</label>
                <select class="form-select" id="tipoDocumento" v-model="filtros.tipo_documento">
                    <option value="" class="placeholder">Seleccione Documento</option>
                    <option v-for="tipo in tiposDocumentos" :key="tipo.id" :value="tipo.id">
                        @{{ tipo.titulo }}
                    </option>
                </select>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 d-flex align-items-center mb-2">
                <label for="numero" class="form-label me-2">Nro.</label>
                <input type="text" class="form-control" id="numero" placeholder="Número" v-model="filtros.numero">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 d-flex align-items-center">
                <label for="anio" class="form-label me-2">Año:</label>
                <input type="text" class="form-control" id="anio" placeholder="Año" v-model="filtros.anio">
            </div>
        </div>
        <div class="row col-12 mb-2">
            <div class="d-flex align-items-center mx-4">
                <label for="sumilla" class="form-label mx-3">Sumilla:</label>
                <textarea class="form-control mx-0" id="sumilla" rows="2" placeholder="Buscar por palabras claves"
                    v-model="filtros.sumilla"></textarea>
            </div>
        </div>
        <div class="col-lg-2 mt-4 col-md-12 col-sm-12">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
</div>


<!--
<h2>Subir Archivo</h2>
<form action="{{ route('minio.subir') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="archivo">Selecciona un archivo:</label>
    <input type="file" name="archivo" id="archivo" required>
    <button type="submit">Subir</button>
</form>-->