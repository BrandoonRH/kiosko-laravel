<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($out = false)
    {
       // return new ProductCollection(Product::where('disponible', 1)->orderBy('id', 'DESC')->paginate(10)); 
       //return new ProductCollection(Product::all()); 
       /*if($out){
        return new ProductCollection(Product::where('disponible', 0)->orderBy('id', 'DESC')->get()); 
       }else{
     
       }*/
       return new ProductCollection(Product::where('disponible', 1)->orderBy('id', 'DESC')->get()); 
    }

    public function productsOut()
    {
        return new ProductCollection(Product::where('disponible', 0)->orderBy('id', 'DESC')->get()); 
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $state = !$product->disponible;
        $product->disponible = $state;
        $product->save(); 
        return [
            "Product" => $product
        ]; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
