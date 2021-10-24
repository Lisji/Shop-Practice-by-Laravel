<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redis;
use App\Http\Services\ShortUrlService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // dd($request -> all());
        // $data = Product::find($request->product_id);
        //// test_effect ///
        // dump(now());
        // for ($i=0; $i < 10000; $i++) { 
        //     DB::table('products')->get();
        // }
        // dump(now());
        $data = json_decode(Redis::get('products'));
        return response($data);
    }

    public function checkProduct(Request $request)
    {
        $id = $request -> all()['id'];
        if(Product::find($id) -> quantity > 0){
            return true;
        }else{
            return false;
        }
    }

    public function shareUrl($id)
    {
        $service = new ShortUrlService();
        $url = $service -> makeShortUrl("http://localhost:8000/products/$id");
        return response(['url' => $url]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->getData();
        $newData = $request->all();
        $data -> push(collect($newData));
        dump($data);
        return response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = $request -> all();
        $data = $this -> getData();
        $selectedData = $data -> where('id', $id) -> first(); 
        $selectedData = $selectedData -> merge(collect($form));
        
        return response($selectedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this -> getData();
        $data = $data->filter(
                function($product) use ($id){
                    return $product['id'] != $id;
                }
            );
        return response($data -> values());
    }
    // fack data
    public function getData()
    {
        return collect([
            collect([
                'id' => 0,
                'title' => 'one',
                'content' => 'one_content',
                'price' => 50,
            ]),
            collect([
                'id' => 1,
                'title' => 'two',
                'content' => 'two_content',
                'price' => 30,
            ]),
            collect([
                'id' => 2,
                'title' => 'three',
                'content' => 'three_content',
                'price' => 45,
            ]),
        ]);
    }
    
}
