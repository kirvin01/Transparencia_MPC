<!-- resources/views/documentos/create.blade.php -->
<h1>Crear Documento</h1>
<form action="{{ route('documentos.store') }}" method="POST">
    @csrf
    <label>Tipo Documento:</label>
    <select name="idtipo_documento">
        @foreach($tipos as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
        @endforeach
    </select>

    <label>Número:</label>
    <input type="text" name="numero">

    <label>Fecha:</label>
    <input type="date" name="fecha">

    <label>Fecha Publicación:</label>
    <input type="datetime-local" name="fechapubli">

    <label>Sumilla:</label>
    <textarea name="sumilla"></textarea>

    <label>URL:</label>
    <input type="url" name="url">

    <label>Estado:</label>
    <select name="idestado">
        @foreach($estados as $estado)
            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
        @endforeach
    </select>

    <label>Contenido HTML:</label>
    <textarea name="html"></textarea>

    <label>Título:</label>
    <input type="text" name="titulo">

    <button type="submit">Guardar</button>
</form>
