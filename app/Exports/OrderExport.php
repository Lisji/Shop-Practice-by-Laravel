<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\Order;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders = Order::with(['user', 'cart.cartItems.product']) -> get();
        $orders = $orders -> map(function($order){
            return [
                $order -> id,
                $order -> user -> name,
                $order -> is_shipped,
                $order -> cart -> cartItems -> sum(function($cartItem){
                    return $cartItem->product->price * $cartItem -> quantity;
                }),
                Date::dateTimeToExcel($order -> created_at),
            ];
        });
        return $orders;
    }

    public function headings():array
    {
        return ['編號', '姓名', '是否運送', '總價', '購買日期'];
    }

    public function columnFormats(): array
    {
        return [
            'B' =>  NumberFormat::FORMAT_TEXT,
            'D' =>  NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E' =>  NumberFormat::FORMAT_DATE_DDMMYYYY,

        ];
    }
}
