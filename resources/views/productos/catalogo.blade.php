<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Catálogo {{ $zona }} - {{ $sucursal }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #fff;
            color: #2c3e50;
            margin: 40px;
            position: relative;
        }

        h3 {
            text-align: center;
            font-weight: 600;
            font-size: 28px;
            margin-bottom: 40px;
            letter-spacing: 1.1px;
            color: #34495e;
            border-bottom: 2px solid #3498db;
            display: inline-block;
            padding-bottom: 8px;
        }

        h4 {
            font-size: 24px;
            margin-top: 40px;
            color: #34495e;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(52, 73, 94, 0.1);
            border-radius: 6px;
            overflow: hidden;
        }

        thead {
            background-color: #ecf0f1;
        }

        thead th {
            padding: 15px 12px;
            font-weight: 600;
            font-size: 14px;
            color: #34495e;
            text-transform: uppercase;
            border-bottom: 1px solid #bdc3c7;
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
            transition: background-color 0.25s ease;
        }

        tbody tr:hover {
            background-color: #f5fbff;
        }

        tbody td {
            padding: 14px 12px;
            vertical-align: middle;
            text-align: left;
            color: #555;
            font-size: 13px;
        }

        tbody td.center {
            text-align: center;
        }

        img {
            width: 200px; /* Aumentar el tamaño de las imágenes */
            height: auto;
            border-radius: 6px;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
            display: block;
            margin: 0 auto;
        }

        .no-image {
            width: 200px;
            height: 200px;
            background-color: #bdc3c7;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 20px;
            font-weight: bold;
            border-radius: 6px;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
        }

        .center {
            text-align: center;
        }

        .price {
            font-weight: 600;
            color: #e74c3c;
        }

        /* Estilo para el QR en la parte superior derecha */
        .qr {
            position: absolute;
            top: 40px;
            right: 40px;
            width: 100px; /* Ajusta el tamaño del QR */
            height: auto;
        }
    </style>
</head>

<body>
    <!-- Aquí se coloca la imagen QR en la parte superior derecha -->
    @if ($zona == 'Norte')
        <img class="qr" src="{{ public_path('QR2.png') }}" alt="QR Norte">
    @elseif ($zona == 'Sur')
        <img class="qr" src="{{ public_path('QR1.png') }}" alt="QR Sur">
    @endif

    <h3>Catálogo {{ $zona }} - {{ $sucursal }}</h3>

    <!-- Hombres -->
    <h4>Hombres</h4>
    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Notas</th>
                <th class="center">Precio Venta {{ $zona }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos->where('genero', 'Hombre') as $producto)
                <tr>
                    <td>{{ $producto->sku }}</td>
                    <td class="center">
                        @if ($producto->imagen)
                            <img src="{{ public_path('storage/' . $producto->imagen) }}" alt="Imagen" />
                        @else
                            <div class="no-image">Sin imagen</div>
                        @endif
                    </td>
                    <td>{{ $producto->producto }}</td>
                    <td>{{ $producto->notas }}</td>
                    <td class="center price">
                        ${{ number_format($zona == 'Norte' ? $producto->valor_venta_norte : $producto->valor_venta_sur, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mujeres -->
    <h4>Mujeres</h4>
    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Notas</th>
                <th class="center">Precio Venta {{ $zona }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos->where('genero', 'Mujer') as $producto)
                <tr>
                    <td>{{ $producto->sku }}</td>
                    <td class="center">
                        @if ($producto->imagen)
                            <img src="{{ public_path('storage/' . $producto->imagen) }}" alt="Imagen" />
                        @else
                            <div class="no-image">Sin imagen</div>
                        @endif
                    </td>
                    <td>{{ $producto->producto }}</td>
                    <td>{{ $producto->notas }}</td>
                    <td class="center price">
                        ${{ number_format($zona == 'Norte' ? $producto->valor_venta_norte : $producto->valor_venta_sur, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Unisex -->
    <h4>Unisex</h4>
    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Notas</th>
                <th class="center">Precio Venta {{ $zona }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos->where('genero', 'Unisex') as $producto)
                <tr>
                    <td>{{ $producto->sku }}</td>
                    <td class="center">
                        @if ($producto->imagen)
                            <img src="{{ public_path('storage/' . $producto->imagen) }}" alt="Imagen" />
                        @else
                            <div class="no-image">Sin imagen</div>
                        @endif
                    </td>
                    <td>{{ $producto->producto }}</td>
                    <td>{{ $producto->notas }}</td>
                    <td class="center price">
                        ${{ number_format($zona == 'Norte' ? $producto->valor_venta_norte : $producto->valor_venta_sur, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
