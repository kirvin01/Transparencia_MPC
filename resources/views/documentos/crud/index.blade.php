<x-default-layout>




    <div class="container mt-4">

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Agregar
            Documento</button>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif



        @foreach ($documentos as $documento)
            <div class="container mt-5">
                <div class="card border">
                    <div class="card-header bg-white">
                        <h5 class="card-title text-center text-uppercase fw-bold">
                            {{ $documento->titulo }}
                        </h5>ñ
                    </div>
                    <div class="card-body d-flex align-items-start">
                        <!-- Columna izquierda (Icono PDF) -->
                        <div class="me-3">
                            <img src="{{ asset('public/assets/media/icons/doc/icon_pdf.webp') }}" alt="PDF Icon" style="width: 70px;">
                            <div class="text-center mt-2">
                                <a href="#" class="text-decoration-none fw-bold">VER</a>
                            </div>
                        </div>
                        <!-- Columna central (Texto largo) -->
                        <div class="flex-grow-1">
                            <p class="mb-2">
                                {{ $documento->sumilla }}
                            </p>
                           
                            <div class="text-end mt-3">
                                <small class="text-muted"> {{ \Carbon\Carbon::parse($documento->fecha )->format('d \d\e F \d\e Y') }}</small>
                            </div>
                        </div>
                        <!-- Columna derecha (Botones de acción) -->
                        <div class="ms-3 text-center">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $documento->id }}"><i class="bi bi-pencil"></i></button>

                            <form action="{{ route('datos-generales.documentos.destroy', $documento) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro de eliminar?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Edit Modal for each document -->
            <div class="modal fade" id="editModal{{ $documento->id }}" tabindex="-1" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Editar Documento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('datos-generales.documentos.update', $documento) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                @include('documentos.crud._form', ['documento' => $documento])
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

    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Crear Documento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('datos-generales.documentos.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @include('documentos.crud._form')
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
