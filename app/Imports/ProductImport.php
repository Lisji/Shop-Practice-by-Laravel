<?php

namespace App\Imports;

use App\Models\product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new product([
            'title' => $row[0],
            'content' => $row[1],
            'price' => $row[2],
            'quantity' => $row[3],
        ]);
    }
}
