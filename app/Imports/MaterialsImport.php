<?php

namespace App\Imports;

use App\Http\Controllers\sendEmailNotificationController;
use App\Models\Materials;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class MaterialsImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Lakukan validasi atau manipulasi data
            $excelDate = intval($row['6']);
            $unixDate = ($excelDate - 25569) * 86400;
            $date = date('Y-m-d', $unixDate);

            $type = '';

            if ($row['1'] === 'Filter') {
                $type = 1;
            } else if ($row['1'] === 'Fast Moving') {
                $type = 2;
            } else if ($row['1'] === 'Slow Moving') {
                $type = 3;
            } else {
                $type = 4;
            }

            // Buat model Materials dari setiap baris data
            $material = ([
                'name'    => $row['0'],
                'slug'    => \Str::slug($row['0']),
                'spesification' => $row['2'],
                'new_stock' => $row['3'],
                'limit_stock' => $row['4'],
                'used_stock' => $row['5'],
                'materials_type_id' => $type,
                'last_placement_date' => $date,
                'purchase_link' => $row['7'],
            ]);

            if ($row['3'] <= $row['4']) {
                $sendEmailNotificationController = new sendEmailNotificationController();
                $sendEmailNotificationController->index();
            }

            Materials::create($material);
        }
    }
}
