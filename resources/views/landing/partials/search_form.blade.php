{{-- resources/views/landing/partials/search_form.blade.php --}}
<div class="bg-light p-4 rounded shadow-sm text-center shadow ">
    <form>
        <div class="row">
            <div class="col-10">
                <div class="row mb-1">
                    <div class="col-lg-8 col-md-6 col-sm-12 d-flex align-items-center mb-2 mb-lg-0">
                        <label for="tipoDocumento" class="form-label me-2" >Tipo de Documento:</label>
                        <select class="form-select" id="tipoDocumento" onchange="removePlaceholder(this)">
                            <option value="" class="placeholder">Seleccione Documento</option>
                            <!-- Opciones cargadas dinámicamente con Vue.js -->
                        </select>
                    </div>
                    
                    <div class="col-lg-2 col-md-3 col-sm-6 d-flex align-items-center mb-2 mb-lg-0">
                        <label for="numero" class="form-label me-2">Nro.</label>
                        <input type="text" class="form-control" id="numero" placeholder="Numero">
                    </div>
                    
                    <div class="col-lg-2 col-md-3 col-sm-6 d-flex align-items-center">
                        <label for="anio" class="form-label me-2">Año:</label>
                        <input type="text" class="form-control" id="anio" placeholder="Año">
                    </div>
                </div>
                
                <div class=" row col-12 mb-2 ">
                    <div class=" d-flex align-items-center mx-4">
                        <label for="sumilla" class="form-label mx-3">Sumilla:</label>                
                        <textarea class="form-control mx-0" id="sumilla" rows="2" placeholder="Buscar por Palabras claves"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 mt-4 col-md-12 col-sm-12">
                <button type="button" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
</div>
