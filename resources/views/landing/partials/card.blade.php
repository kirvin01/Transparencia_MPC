{{-- resources/views/landing/partials/card.blade.php --}}
<!-- 

<div class="col-md-12 mb-3" v-for="documento in documentos" :key="documento.id">
    <div class="card shadow-sm">
        <div class="card-body d-flex align-items-center justify-content-center">
           
            <div class="me-3 d-flex align-items-center justify-content-center h-100">
                <img src="{{ asset('assets/media/icons/doc/icon-pdf.webp') }}" alt="PDF Icon" style="width: 90px; height: auto;">
            </div>
        
            <div class="w-100">
                <h5 class="card-title text-uppercase bg-secondary">@{{ documento.titulo }}</h5>
                <p class="card-text text-muted">@{{ documento.sumilla }}</p>
                <p class="text-end fw-bold text-muted">@{{ documento.fecha }}</p>
            </div>
        </div>
    </div>
</div>
-->
<div class="conte"></div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 mb-3" v-for="documento in documentos" :key="documento.id">
        <div class="card shadow-sm h-100 bg-image-mpc">
            <div class="card-body text-center">
                <!-- Logo PDF 
                <div class="mb-3">
                    <img src="{{ asset('assets/media/icons/doc/icon-pdf.webp') }}" alt="PDF Icon" class="img-fluid" style="width: 60px; height: auto;">
                </div>-->
                <!-- Descripción del Documento -->
                <h6 class="card-title text-uppercase text-custom fw-bold">@{{ documento.titulo }}</h6>
                <hr class="my-1 bg-secondary ">
                <p class="card-text text-muted small text-limit text-justify" >@{{ documento.sumilla }}</p>
                <p class="text-end fw-bold text-muted small"><i class="fa-solid fa-calendar-days"></i> @{{ documento.fechaFormateada }}</p>
                <!-- Botón de acción -->
                
                <a href="#" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i> Ver</a>
            </div>
        </div>
    </div>
</div>

</div>



