<?php

namespace App\Http\Controllers\Admin;

use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Notifications\ProductDelivery;

use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $ProductCount = Product::count();
        $dataPerPage = 2;
        $ProductPages = ceil( $ProductCount / $dataPerPage );
        $currentPage = isset($request -> all()['page'] ) ? $request -> all()['page'] : 1;
        $Products = Product::orderBy('created_at', 'asc')
                        ->offset($dataPerPage * ($currentPage - 1))
                        ->limit($dataPerPage)
                        ->get();
        return view('admin.products.index', [
                                            'Products' => $Products,
                                            'ProductCount' => $ProductCount,
                                            'ProductPages' => $ProductPages
                                        ]);
    }

    public function uploadImg(Request $request){
        $file = $request -> file('product_img');
        $productId = $request -> input('product_id');
        if(is_null($productId)){
            return redirect() -> back() -> withErrors(['msg' => 'parameter error']);
        }
        $product = Product::find($productId);
        $path = $file -> store('public/images');
        $product -> images() -> create([
            'filename' => $file -> getClientOriginalName(),
            'path' => $path
        ]);
        return redirect() -> back();
    }

    public function import(Request $request){
        $file = $request -> file('excel');
        Excel::import(new ProductImport, $file);

        return redirect()->back();
    }

}
