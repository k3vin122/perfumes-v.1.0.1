@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="mb-4 text-center">Editar Perfume</h2>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('perfumes.update', $perfume->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="marca" class="form-label">Marca</label>
          <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $perfume->marca) }}" required>
        </div>

        <div class="mb-3">
          <label for="producto" class="form-label">Producto</label>
          <input type="text" class="form-control" id="producto" name="producto" value="{{ old('producto', $perfume->producto) }}" required>
        </div>

        <div class="mb-3">
          <label for="genero" class="form-label">Género</label>
          <input type="text" class="form-control" id="genero" name="genero" value="{{ old('genero', $perfume->genero) }}">
        </div>

        <div class="mb-3">
          <label for="precio" class="form-label">Precio</label>
          <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio', $perfume->precio) }}" required>
        </div>

        <div class="mb-3">
          <label for="notas_aroma" class="form-label">Notas de Aroma</label>
          <textarea class="form-control" id="notas_aroma" name="notas_aroma" rows="3">{{ old('notas_aroma', $perfume->notas_aroma) }}</textarea>
        </div>

        <div class="mb-3">
          <label for="imagen" class="form-label">Imagen</label>
          <input class="form-control" type="file" id="imagen" name="imagen">
          @if($perfume->imagen)
            <img src="{{ asset('storage/' . $perfume->imagen) }}" alt="Imagen actual" class="img-thumbnail mt-3" style="max-width: 150px;">
          @endif
        </div>

        <div class="d-flex justify-content-between">
          <a href="{{ route('perfumes.index') }}" class="btn btn-secondary">Cancelar</a>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
