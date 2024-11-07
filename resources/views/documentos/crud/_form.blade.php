@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="idtipo_documento" class="form-label fw-bold">Tipo de Documento</label>
    <select name="idtipo_documento" id="idtipo_documento" class="form-select" required>
        @foreach ($tipos as $tipo)
            <option value="{{ $tipo->id }}" 
                {{ old('idtipo_documento', $documento->idtipo_documento ?? '') == $tipo->id ? 'selected' : '' }}>
                {{ $tipo->titulo }}
            </option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col mb-3">
        <label for="numero" class="form-label fw-bold">Número</label>
        <input type="text" name="numero" id="numero" class="form-control" 
               value="{{ old('numero', $documento->numero ?? '') }}" required>
    </div>

    <div class="col mb-3">
        <label for="fecha" class="form-label fw-bold">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" 
               value="{{ old('fecha', isset($documento->fecha) ? \Carbon\Carbon::parse($documento->fecha)->format('Y-m-d') : '') }}" required>
    </div>
</div>

<div class="mb-3">
    <label for="sumilla" class="form-label fw-bold">Sumilla</label>
    <textarea name="sumilla" id="sumilla" class="form-control" required>{{ old('sumilla', $documento->sumilla ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="url" class="form-label fw-bold">Subir PDF</label>
    <input type="file" name="url" id="url" class="form-control" accept="application/pdf" {{ isset($documento) ? '' : 'required' }}>
    @if(isset($documento) && $documento->url)
        <small class="form-text text-muted">Archivo actual: 
            <a href="{{ asset('storage/' . $documento->url) }}" target="_blank">Ver PDF actual</a>
        </small>
    @endif
</div>

<div class="mb-3">
    <label for="idestado" class="form-label fw-bold">Estado</label>
    <select name="idestado" id="idestado" class="form-select" required>
        @foreach ($estados as $estado)
            <option value="{{ $estado->id }}" 
                {{ old('idestado', $documento->idestado ?? '') == $estado->id ? 'selected' : '' }}>
                {{ $estado->descripcion }}
            </option>
        @endforeach
    </select>
</div>
