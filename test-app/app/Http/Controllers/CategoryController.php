<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
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
    public function store(CategoryStoreRequest $request)
    {

        $name = $request->input('name');

        $uuid = Str::uuid();
        $category = Category::create([
            'id' => $uuid,
            'name' => $name,
        ]);

        if($category)
        {
            $categoryData = Category::find($uuid)->first()->toArray();

            if ($categoryData) {
                
                $data['id'] = $uuid;
                $data['name'] = $categoryData['name'];
                $data['createdAt'] = $categoryData['created_at'];

                return ResponseFormatter::success(
                    $data,
                    'Data category berhasil ditambahkan'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data category gagal ditambahkan',
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

    public function cobacoba()
    {
        dd("masuk");
    }
}
