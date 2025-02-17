<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Category;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->ajax() ? Category::with('residule')->paginate(50) : abort(404);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, $data)
    {
        return $request->ajax() ? Category::with('residule')->where('name', 'like', "%{$data}%")
        ->paginate(50) : abort(404);
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
            "name" => ['required', 'string', 'unique:categories,name'],            
            "residule_id" => ['required', 'integer', 'max:191'],            
        ]);
     
        $category = Category::create($request->all());

        return response()->json(['success' => 'Category created successfully'],Response::HTTP_OK);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            "residule_id" => ['required', 'integer', 'max:191'],            
        ]);

        $vicommCategory = Category::findOrFail($id);

        $vicommCategory->update($request->all());

        return response()->json(['success' => 'Category updated successfully', 'category'=> $vicommCategory],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Category = Category::findOrFail($id);

        $Category->delete();

        return response()->json(['success' => 'Category deleted successfully'],Response::HTTP_OK);
    }
}
