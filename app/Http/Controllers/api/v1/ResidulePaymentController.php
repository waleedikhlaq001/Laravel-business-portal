<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResidulePayment;
use App\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class ResidulePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->ajax() ? ResidulePayment::paginate(50) : abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, $data)
    {
        return $request->ajax() ? ResidulePayment::where('name', 'like', "%{$data}%")
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
            "percentage" => ['required', 'integer', 'max:100'],            
        ]);
     
        $category = ResidulePayment::create($request->all());

        return response()->json(['success' => 'ResidulePayment created successfully'],Response::HTTP_OK);
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
            "percentage" => ['required', 'integer', 'max:100'],            
        ]);

        $vicommResidulePayment = ResidulePayment::findOrFail($id);

        $vicommResidulePayment->update($request->all());

        return response()->json(['success' => 'ResidulePayment updated successfully', 'category'=> $vicommResidulePayment],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ResidulePayment = ResidulePayment::findOrFail($id);

        $ResidulePayment->delete();

        return response()->json(['success' => 'ResidulePayment deleted successfully'],Response::HTTP_OK);
    }
}
