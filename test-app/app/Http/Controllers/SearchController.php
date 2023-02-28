<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use App\Helpers\ResponseFormatter;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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


    public function search(Request $request)
    {

        $products = Product::with('category');

        if($request->query('price_start')) {

            $products->where('price', '>=', $request->query('price_start'));

            if($request->query('price_end')) {

                $products->where('price', '<=', $request->query('price_end'));

            }
        }

        if($request->query('stock_start')) {

            $products->where('stock', '>=', $request->query('stock_start'));

            if($request->query('stock_end')) {

                $products->where('stock', '<=', $request->query('stock_end'));

            }
        }

        if($request->query('category_name')) {
            $categoryName = $request->query('category_name');
            $products->whereHas('category',  function($q) use($categoryName){
                    $q->where('categories.name', 'like','%'. $categoryName . '%');
                }
            );

            
        }

        if($request->query('name')) {
            $productName = $request->query('name');
            $products->where('name', 'like','%'. $productName . '%');
            
        }

        if($request->query('sku')) {
            $productSKU = $request->query('sku');
            $products->where('sku', '=',$productSKU);
        }

        if($request->query('category_id')) {
            $categoryIdFilter = $request->query('category_id');
            $products->whereHas('category',  function($q) use($categoryIdFilter){
                    $q->where('categories.id', '=', $categoryIdFilter);
                }
            );
        }

        $products = $products->paginate(10)->toArray();

        if ($products) {

            $data = null;
            $paging = null;

            if (count($products['data']) > 0) {


                foreach ($products['data'] as $index => $value) {

                    $data[$index]['id'] = $value['id'];
                    $data[$index]['sku'] = $value['sku'];
                    $data[$index]['name'] = $value['name'];
                    $data[$index]['price'] = $value['price'];
                    $data[$index]['stock'] = $value['stock'];
                    $data[$index]['stock'] = $value['stock'];
                    $data[$index]['category']['id'] = $value['category']['id'];
                    $data[$index]['category']['name'] = $value['category']['name'];
                    $data[$index]['createdAt']= $value['created_at'];

                }
                $paging['size'] = $products['per_page'];
                $paging['total'] = $products['total'];
                $paging['current'] = $products['current_page'];
            }
                
            return ResponseFormatter::success(
                $data,
                'Data product berhasil ditampilkan',
                $paging,
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data product gagal ditampilkan',
                404
            );
        }


    }
}

