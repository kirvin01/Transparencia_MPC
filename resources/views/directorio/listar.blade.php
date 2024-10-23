<x-default-layout>

    @section('title')
        Lista de Directorios
    @endsection

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <form action="{{ route('datos-generales.directorio.index') }}" method="GET"
                    class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control form-control-solid w-300px ps-13" placeholder="Buscar en todos los campos">
                </form>
            </div>

            <!-- Botón para crear un nuevo directorio -->
            <a href="javascript:void(0)" class="btn btn-primary d-flex align-items-center gap-2 px-2 py-1 shadow-sm"
                data-bs-toggle="modal" data-bs-target="#directorioModal" id="createButton">
                {!! getIcon('plus', 'fs-2', '', 'i') !!}
                <span class="fw-semibold">Crear Nuevo</span>
            </a>
        </div>

        <div class="card-body py-4">
            <div class="row" id="directorioContainer">
                @foreach ($directorios as $directorio)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <!-- Mostrar la foto si existe, o una imagen por defecto -->
                                <img src="{{ $directorio->foto ? asset('storage/' . $directorio->foto) : asset('storage/directorios/default.png') }}"
                                    alt="Foto de {{ $directorio->nombre }}" class="img-fluid rounded-circle mb-3"
                                    style="width: 100px; height: 100px; object-fit: cover;">



                                <h5 class="card-title">{{ $directorio->nombre }} {{ $directorio->apellidos }}</h5>
                                <p class="text-muted">{{ $directorio->cargo }}</p>
                                <p>{{ $directorio->correo }}</p>
                                <p>{{ $directorio->telefono }}</p>

                                <button type="button" class="btn btn-warning btn-sm me-2 editButton"
                                    data-id="{{ $directorio->id }}" data-bs-toggle="modal"
                                    data-bs-target="#directorioModal">Editar</button>

                                <form action="{{ route('datos-generales.directorio.destroy', $directorio) }}"
                                    method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $directorios->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- Modal para crear o editar un directorio -->
    <div class="modal fade" id="directorioModal" tabindex="-1" aria-labelledby="directorioModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="directorioModalLabel">Crear/Editar Directorio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Aquí se cargará el formulario --}}
                    <div id="modalFormContainer">
                        <!-- El contenido del formulario se cargará mediante AJAX -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Configurar el modal para crear un nuevo directorio
            document.getElementById('createButton').addEventListener('click', function() {
                fetchForm('{{ route('datos-generales.directorio.create') }}');
            });

            // Configurar el modal para editar un directorio
            document.querySelectorAll('.editButton').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    fetchForm(`{{ url('datos-generales/directorio') }}/${id}/edit`);
                });
            });

            // Función para cargar el formulario mediante AJAX
            function fetchForm(url) {
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('modalFormContainer').innerHTML = html;
                    });
            }
        </script>
    @endpush

</x-default-layout>
