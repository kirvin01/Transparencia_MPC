<div class="mb-3">
    <label for="idtipo_documento" class="form-label">Tipo de Documento</label>
    <select name="idtipo_documento" class="form-control" required>
        @foreach ($tipos as $tipo)
            <option value="{{ $tipo->id }}" {{ (isset($documento) && $documento->idtipo_documento == $tipo->id) ? 'selected' : '' }}>
                {{ $tipo->titulo }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="numero" class="form-label">Número</label>
    <input type="text" name="numero" class="form-control" value="{{ $documento->numero ?? '' }}" required>
</div>

<div class="mb-3">
    <label for="fecha" class="form-label">Fecha</label>
    <input type="date" name="fecha" class="form-control" value="{{ $documento->fecha ?? '' }}" required>
</div>

<div class="mb-3">
    <label for="sumilla" class="form-label">Sumilla</label>
    <textarea name="sumilla" class="form-control" required>{{ $documento->sumilla ?? '' }}</textarea>
</div>

<div class="mb-3">
    <label for="url" class="form-label">URL</label>
    <input type="url" name="url" class="form-control" value="{{ $documento->url ?? '' }}" required>
</div>

<div class="mb-3">
    <label for="idestado" class="form-label">Estado</label>
    <select name="idestado" class="form-control" required>
        @foreach ($estados as $estado)
            <option value="{{ $estado->id }}" {{ (isset($documento) && $documento->idestado == $estado->id) ? 'selected' : '' }}>
                {{ $estado->descripcion }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="titulo" class="form-label">Título</label>
    <input type="text" name="titulo" class="form-control" value="{{ $documento->titulo ?? '' }}" required>
</div>
