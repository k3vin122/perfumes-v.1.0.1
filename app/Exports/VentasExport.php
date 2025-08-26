<?php

namespace App\Exports;

use App\Models\Venta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VentasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Retornar todas las ventas (puedes agregar filtros si es necesario)
        return Venta::with('producto')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Producto',
            'Zona',
            'Cantidad',
            'Precio Unitario',
            'Total',
            'Fecha',
        ];
    }

    /**
     * @param mixed $venta
     * @return array
     */
    public function map($venta): array
    {
        return [
            $venta->id,
            $venta->producto->producto,
            $venta->zona,
            $venta->cantidad_vendida,
            number_format($venta->precio_unitario, 0, ',', '.'),
            number_format($venta->total, 0, ',', '.'),
            $venta->created_at->format('d-m-Y H:i'),
        ];
    }
}
