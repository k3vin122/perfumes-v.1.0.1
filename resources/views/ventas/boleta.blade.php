<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Boleta de Venta</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #fff;
            color: #2c3e50;
            margin: 0 auto;
            max-width: 800px;
            padding: 30px 40px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #1a237e;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .header img {
            max-width: 180px;
            height: auto;
            opacity: 0.85; /* Logo con transparencia */
        }

        h2 {
            text-align: center;
            font-weight: 700;
            font-size: 24px;
            margin: 20px 0 30px;
            letter-spacing: 2px;
            color: #1a237e;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        thead {
            background-color: #1a237e;
            color: #ffffff;
        }

        th, td {
            padding: 10px 15px;
            border-bottom: 1px solid #ccc;
            text-align: center;
            font-size: 14px;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        .product-image img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
            border: 1px solid #ddd;
            display: block;
            margin: 0 auto;
        }

        .totals {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #1a237e;
        }

        .details {
            text-align: right;
            font-size: 12px;
            color: #555;
            font-style: italic;
            margin-top: 15px;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: #999;
            margin-top: 50px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        @media print {
            body {
                margin: 10mm 15mm 10mm 15mm;
            }
            table, tr, td, th, thead, tbody {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo_empresa_header.png') }}" alt="Logo Empresa" />
    </div>

    <h2>Boleta de Venta</h2>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>SKU</th>
                <th>Zona</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventaCabecera->ventas as $venta)
            <tr>
                <td>{{ $venta->producto->producto }}</td>
                <td>{{ $venta->producto->sku }}</td>
                <td>{{ $venta->zona }}</td>
                <td>{{ $venta->cantidad_vendida }}</td>
                <td>${{ number_format($venta->precio_unitario, 0, ',', '.') }}</td>
                <td>${{ number_format($venta->total, 0, ',', '.') }}</td>
                <td class="product-image">
                    @if ($venta->producto->imagen)
                        <img src="{{ public_path('storage/' . $venta->producto->imagen) }}" alt="Producto" />
                    @else
                        <span style="font-style: italic; color: #bbb;">Sin imagen</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        Total a Pagar: ${{ number_format($ventaCabecera->total, 0, ',', '.') }}
    </div>

    <div class="details">
        Fecha: {{ $ventaCabecera->created_at->format('d-m-Y H:i') }}
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} K Y C - Venta de Perfumes Árabes -
