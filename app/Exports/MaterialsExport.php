<?php

namespace App\Exports;

use App\Models\Materials;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaterialsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil data Materials beserta relasi materials_type
        $materials = Materials::with('materials_type')->get();

        // Transformasi data sesuai kebutuhan
        $materials->transform(function ($material) {
            return [
                'ID' => $material->id,
                'Name' => $material->name,
                'Materials Type' => $material->materials_type ? $material->materials_type->name : null,
                'Specification' => $material->spesification,
                'New Stock' => $material->new_stock,
                'Limit Stock' => $material->limit_stock,
                'Used Stock' => $material->used_stock,
                'Last Placement Date' => Carbon::parse($material->last_placement_date)->format('d/m/Y'),
                'Purchase Link' => $material->purchase_link,
            ];
        });

        return $materials;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Menentukan judul kolom untuk file Excel
        return [
            'No',
            'Material Name',
            'Material Type',
            'Spesification',
            'New Stock',
            'Limit Stock',
            'Used Stock',
            'Last Replacement Date',
            'Purchase Link',
        ];
    }
}
