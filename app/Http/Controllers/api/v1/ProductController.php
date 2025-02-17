<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Product;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class ProductController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->ajax() ? Product::with('vendor')->latest()->paginate(50) : abort(404);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, $data)
    {
        return $request->ajax() ? Product::where('name', 'like', "%{$data}%")
        ->with('vendor')->latest()->paginate(20) : abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            "name" => ['required', 'string', 'max:30'],
            "price" => ['required', 'integer'],
            "description" => [ 'string', 'max:1000', "max:191"],
            "vendor_id" => ['required', 'integer'],
            "category_id" => ['required', 'integer'],
            "unique_id" => ['required', 'text', 'unique:products,unique_id'],
        ]);


        $Product = Product::create($request->all());

        return response()->json(['success' => 'Product created successfully', 'product'=>$Product],Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vicommProduct = Product::with('vendor','job','category')->findOrFail($id);
        return response()->json(['success' => 'Product updated successfully', 'product'=> $vicommProduct],Response::HTTP_OK);
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
        $this->validate($request, [
            "name" => ['required', 'string', 'max:30'],
            "price" => ['required', 'integer'],
            "description" => [ 'string', 'max:191'],
            "vendor_id" => ['required', 'integer'],
            "category_id" => ['required', 'integer'],
        ]);

        $vicommProduct = Product::with('vendor')->findOrFail($id);

        $vicommProduct->update($request->all());

        return response()->json(['success' => 'Product updated successfully', 'product'=> $vicommProduct],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product = Product::findOrFail($id);

        $Product->delete();

        return response()->json(['success' => 'Product deleted successfully'],Response::HTTP_OK);
    }
}
