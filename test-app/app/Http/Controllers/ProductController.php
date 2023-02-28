<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->get()->toArray();

        dd($products);
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
    public function store(ProductStoreRequest $request)
    {
        $sku = $request->input('sku');
        $name = $request->input('name');
        $price = $request->input('price');
        $stock = $request->input('stock');
        $categoryId = $request->input('categoryId');
        

        // check catagory
        $category = Category::where('id',$categoryId)->first();


        if(!$category) {
            return ResponseFormatter::error(
                null,
                'Data category tidak ditemukan',
                404
            );
        }


        $uuid = Str::uuid();

        $product = new Product;
        $product->id = $uuid;
        $product->name = $name;
        $product->sku = $sku;
        $product->price = $price;
        $product->stock = $stock;
        $product->category_id = $categoryId;
        $product->save();

        // $product = Product::create([
        //     'id' => $uuid,
        //     'sku' => $sku,
        //     'name' => $name,
        //     'price' => $price,
        //     'stock' => $stock,
        //     'category_id' => $categoryId,
        // ]);


        if($product)
        {
            $productData = Product::where('id',$uuid)->first()->toArray();

            if ($productData) {
                
                $data['id'] = $uuid;
                $data['sku'] = $productData['sku'];
                $data['name'] = $productData['name'];
                $data['price'] = $productData['price'];
                $data['stock'] = $productData['stock'];
                $data['createdAt'] = $productData['created_at'];
                $data['category'] =[
                    "id" => $categoryId,
                    "name" => $category["name"]
                ];
                return ResponseFormatter::success(
                    $data,
                    'Data product berhasil ditambahkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data product gagal ditambahkan',
                    404
                );
            }

                 
        }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
