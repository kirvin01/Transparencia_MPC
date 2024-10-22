<x-default-layout>
    @section('title')
        <div class="container mt-5">
            <h1 class="mb-4">Lista de Directorios</h1>

            <!-- Botón para crear un nuevo directorio -->
            <div class="d-flex justify-content-between mb-3">
                <form action="{{ route('datos-generales.directorio.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Buscar por nombre o cargo" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
                <a href="{{ route('datos-generales.directorio.create') }}" class="btn btn-success">Crear Nuevo</a>
            </div>

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Tabla de directorios -->
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Cargo</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($directorios as $directorio)
                            <tr>
                                <td>{{ $directorio->id }}</td>
                                <td>
                                    <img src="{{ $directorio->foto }}" alt="Foto" class="img-thumbnail" style="width: 80px; height: 80px;">
                                </td>
                                <td>{{ $directorio->cargo }}</td>
                                <td>{{ $directorio->nombre }}</td>
                                <td>{{ $directorio->apellidos }}</td>
                                <td>{{ $directorio->correo }}</td>
                                <td>{{ $directorio->telefono }}</td>
                                <td>
                                    <a href="{{ route('datos-generales.directorio.edit', $directorio) }}" class="btn btn-warning btn-sm me-1">Editar</a>
                                    <form action="{{ route('datos-generales.directorio.destroy', $directorio) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                {{ $directorios->links('pagination::bootstrap-5ñ') }}
            </div>
        </div>
    @endsection
</x-default-layout>
