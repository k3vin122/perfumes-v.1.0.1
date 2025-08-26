@extends('layouts.app')

@section('content')


    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Crear Perfume</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100 font-sans">

        <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Guarda un nuevo perfume</h1>

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('perfumes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="marca">Marca:</label>
                    <input type="text" name="marca" id="marca" value="{{ old('marca') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="producto">Producto:</label>
                    <input type="text" name="producto" id="producto" value="{{ old('producto') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="genero">Género:</label>
                    <input type="text" name="genero" id="genero" value="{{ old('genero') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="precio">Precio:</label>
                    <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="notas_aroma">Notas de Aroma:</label>
                    <textarea name="notas_aroma" id="notas_aroma" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('notas_aroma') }}</textarea>
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700" for="imagen">Imagen:</label>
                    <input type="file" name="imagen" id="imagen" class="w-full text-gray-700" />
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded transition duration-300">
                    Guardar
                </button>

                <a href="{{ route('perfumes.index') }}"
                    class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded transition duration-300">
                    Volver
                </a>
            </form>
        </div>

    </body>

    </html>
@endsection
