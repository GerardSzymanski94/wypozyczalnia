<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', 1)->get();
        $additionals = Product::where('status', 2)->get();
        return view('admin.product.list', compact('products', 'additionals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    public function createAdditional()
    {
        return view('admin.product.create_additional');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('images/' . $product->id . '/');
            Image::create([
                'url' => $photo,
                'order' => 1,
                'product_id' => $product->id
            ]);
        }
        return redirect()->route('admin.product.index')->with('add', true);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    public function editAdditional(Product $product)
    {
        return view('admin.product.edit_additional', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('images/' . $product->id . '/');
            Image::updateOrCreate([
                'order' => 1,
                'product_id' => $product->id
            ], [
                'url' => $photo,
            ]);
        }
        return redirect()->route('admin.product.index')->with('add', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('delete', true);
    }
}
