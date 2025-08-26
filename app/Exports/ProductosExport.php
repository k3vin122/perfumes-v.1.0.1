<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductosExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Asegúrate de que todos los campos estén siendo seleccionados
        return Producto::select(
            'sku',
            'marca',
            'producto',
            'genero',
            'valor_compra',
            'valor_venta_sur',
            'valor_venta_norte',
            'ganancia_sur',
            'ganancia_norte',
            'cantidad',
            'sucursal',
            'notas'
        )->get();
    }

    /**
     * Define los encabezados de las columnas.
     * 
     * @return array
     */
    public function headings(): array
    {
        return [
            'SKU',
            'Marca',
            'Producto',
            'Género',
            'Compra',
            'Venta Sur',
            'Venta Norte',
            'Ganancia Sur',
            'Ganancia Norte',
            'Cantidad',
            'Sucursal',
            'Notas',
        ];
    }
}
