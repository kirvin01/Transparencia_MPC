<x-default-layout>

    @section('title')
        Lista de Directorios
    @endsection

    @section('breadcrumbs')
        <!-- Breadcrumbs si lo necesitas -->
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search Form-->
                <form action="{{ route('datos-generales.directorio.index') }}" method="GET" class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-solid w-300px ps-13" placeholder="Buscar en todos los campos">
                </form>
                <!--end::Search Form-->
            </div>
            <!--end::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add directorio-->
                    <a href="{{ route('datos-generales.directorio.create') }}" class="btn btn-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Crear Nuevo
                    </a>
                    <!--end::Add directorio-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Directorio Cards-->
            <div class="row" id="directorioContainer">
                @foreach ($directorios as $directorio)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <!-- Foto en círculo -->
                                <img src="{{ asset($directorio->foto) }}" alt="Foto de {{ $directorio->nombre }}" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">

                                <!-- Información del Directorio -->
                                <h5 class="card-title">{{ $directorio->nombre }} {{ $directorio->apellidos }}</h5>
                                <p class="text-muted">{{ $directorio->cargo }}</p>
                                <p>{{ $directorio->correo }}</p>
                                <p>{{ $directorio->telefono }}</p>

                                <!-- Botones de acción -->
                                <a href="{{ route('datos-generales.directorio.edit', $directorio) }}" class="btn btn-warning btn-sm me-2">Editar</a>
                                <form action="{{ route('datos-generales.directorio.destroy', $directorio) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--end::Directorio Cards-->

            <!--begin::Pagination-->
            <div class="d-flex justify-content-end mt-4">
                {{ $directorios->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
            </div>
            <!--end::Pagination-->
        </div>
        <!--end::Card body-->
    </div>

</x-default-layout>
