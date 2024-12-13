<x-default-layout>
    <div class="container mt-4">
        <!-- Formulario de búsqueda -->
        <form action="{{ route('datos-generales.documentos.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Buscar documentos..."
                    value="{{ old('search', $keyword) }}">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>

        <!-- Botón para abrir el modal de creación -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Agregar
            Documento</button>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Lista de Documentos -->
        @foreach ($documentos as $documento)
            <div class="container mt-5">
                <div class="card border">
                    <div class="card-header bg-white">
                        <h5 class="card-title text-center text-uppercase fw-bold">{{ $documento->titulo }}</h5>
                    </div>
                    <div class="card-body d-flex align-items-start">
                        <div class="me-3">
                            <img src="{{ asset('assets/media/icons/doc/icon-pdf.webp') }}" alt="PDF Icon"
                                style="width: 70px;">
                            <div class="text-center mt-2">

                               @php
                                    $fileExists =
                                        filter_var($documento->url, FILTER_VALIDATE_URL) &&
                                        preg_match(
                                            '/^https?:\/\/[\w\-\.]+\.\w+(\/[\w\-\/\.]+)?\.pdf$/i',
                                            $documento->url,
                                        );
                                @endphp
                                @if ($fileExists)
                                    <!-- Botón "VER" que abre el modal, pasa la URL y el título del documento -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#pdfModal"
                                        data-pdf-url="{{ $documento->url }}" data-title="{{ $documento->titulo }}"
                                        class="text-decoration-none fw-bold open-pdf-modal">VER </a>
                                @else
                                    <span class="text-muted">Archivo no disponible </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-2">{{ $documento->sumilla }}</p>
                            <div class="text-end mt-3">
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($documento->fecha)->format('d \\d\\e F \\d\\e Y') }}</small>
                            </div>
                        </div>
                        <div class="ms-3 text-center">
                            <button class="btn btn-warning btn-sm mb-4" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $documento->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('datos-generales.documentos.destroy', $documento) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro de eliminar?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de edición para cada documento -->
            <div class="modal fade" id="editModal{{ $documento->id }}" tabindex="-1"
                aria-labelledby="editModalLabel{{ $documento->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $documento->id }}">Editar Documento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('datos-generales.documentos.update', $documento) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                @include('documentos.crud._form', [
                                    'documento' => $documento,
                                    'tipos' => $tipos,
                                    'estados' => $estados,
                                ])
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Enlaces de paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $documentos->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Modal de visualización del PDF -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Título del Documento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfIframe" src="" width="100%" height="500px" style="border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de creación de documento -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Crear Documento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('datos-generales.documentos.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @include('documentos.crud._form', [
                            'documento' => null,
                            'tipos' => $tipos,
                            'estados' => $estados,
                        ])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>

<!-- Script para manejar la visualización del PDF en el modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const pdfModal = document.getElementById("pdfModal");
        const pdfIframe = document.getElementById("pdfIframe");
        const pdfModalLabel = document.getElementById("pdfModalLabel");

        document.querySelectorAll(".open-pdf-modal").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const pdfUrl = this.getAttribute("data-pdf-url");
                const pdfTitle = this.getAttribute("data-title");
                pdfIframe.src = pdfUrl;
                pdfModalLabel.textContent = pdfTitle; // Cambia el título del modal
            });
        });

        pdfModal.addEventListener("hidden.bs.modal", function() {
            pdfIframe.src = ""; // Limpiar el src para evitar que siga cargando en segundo plano
        });
    });
</script>
