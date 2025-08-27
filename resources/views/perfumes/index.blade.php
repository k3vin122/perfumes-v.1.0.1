@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-3">
            Lista de Perfumes que podemos pedir!!!!
        </h1>

        <!-- ALERTA MOTIVACIONAL AQUÍ -->
        <div class="alert alert-success text-center fw-semibold">
            El éxito es la suma de pequeños esfuerzos, repetidos día tras día.
        </div>

        <div class="text-center mb-4">
            <a href="{{ route('perfumes.create') }}" class="btn btn-primary">
                Agregar Nuevo
            </a>
        </div>

        <div class="row g-4">
            @foreach ($perfumes as $perfume)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        @if ($perfume->imagen)
                            <img src="{{ asset('storage/app/public/' . $perfume->imagen) }}" class="card-img-top"
                                alt="Imagen de {{ $perfume->producto }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center"
                                style="height: 200px; color: white;">
                                Sin imagen
                            </div>
                        @endif

                        <p>Ruta: {{ $perfume->imagen }}</p>


                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $perfume->marca }} - {{ $perfume->producto }}</h5>
                            <p class="card-text mb-1"><strong>Género:</strong> {{ $perfume->genero }}</p>
                            <p class="card-text mb-1"><strong>Precio:</strong>
                                ${{ number_format($perfume->precio, 2, ',', '.') }}</p>
                            <p class="card-text mb-3"><strong>Notas:</strong> {{ $perfume->notas_aroma }}</p>

                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ route('perfumes.edit', $perfume->id) }}" class="btn btn-warning flex-grow-1">
                                    Editar
                                </a>

                                <form action="{{ route('perfumes.destroy', $perfume->id) }}" method="POST"
                                    onsubmit="return confirm('¿Quieres eliminar este perfume?');" class="flex-grow-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
