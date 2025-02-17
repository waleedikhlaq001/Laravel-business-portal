<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->ajax() ? User::with('role','details', 'ambassador')->latest()->paginate(50) : abort(404);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, $data)
    {
        return $request->ajax() ? User::where('email', 'like', "%{$data}%")
        ->orWhere('first_name', 'like', "%{$data}%")
        ->orWhere('last_name', 'like', "%{$data}%")
        ->orWhere('street_address', 'like', "%{$data}%")
        ->orWhere('postal_code', 'like', "%{$data}%")
        ->orWhere('city', 'like', "%{$data}%")
        ->orWhere('phone_number', 'like', "%{$data}%")
        ->orWhere('facebook', 'like', "%{$data}%")
        ->orWhere('instagram', 'like', "%{$data}%")
        ->orWhere('tiktok', 'like', "%{$data}%")
        ->orWhere('snapchat', 'like', "%{$data}%")
        ->orWhere('telegram', 'like', "%{$data}%")
        ->orWhere('twitter', 'like', "%{$data}%")
        ->with('role','details', 'ambassador')->latest()->paginate(50) : abort(404);
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
            "email" => ['required', 'email', 'unique:users,email'],            
            "phone_number" => ['string', 'unique:users,phone_number'],            
            "last_name" => ['required', 'string'],
            "first_name" => ['required', 'string'],            
            "postal_code" => ['required', 'integer'],            
            "city" => ['required', 'string'],            
            "country_id" => ['required', 'integer'],            
        ]);

        $selectedRole = !empty($request['role'])? $request['role']: 'General User';

        $role = Role::where('name', $selectedRole)->first();
     
        $user = User::create([
                'last_name' => $request['last_name'],
                'first_name' => $request['first_name'],
                'phone_number' => $request['phone_number'],
                'street_address' => $request['street_address'],
                'status' => $request['status'],
                'city' => $request['city'],
                'postal_code' => $request['postal_code'],
                'facebook' => $request['facebook'],
                'instagram' => $request['instagram'],
                'tiktok' => $request['tiktok'],
                'snapchat' => $request['snapchat'],
                'telegram' => $request['telegram'],
                'twitter' => $request['twitter'],
                'email' => $request['email'],
                'country_id' => $request['country_id'],
                'password' => \Hash::make($request['password']),
                'email_verified_at' => Carbon::now(),
        ]);

         $user->role()->attach($role->id); // role 5 is a general user id
         $newVicommUser = User::with('role','details')->findOrFail($user->id);
        return response()->json(['success' => 'User created successfully', 'user'=>$newVicommUser],Response::HTTP_OK);
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
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'postal_code' => 'required|integer',
            'city' => 'required|string',
            'country_id' => 'required',
        ]);

        $vicommUser = User::with('role','details')->findOrFail($id);

        $vicommUser->update($request->all());

        return response()->json(['success' => 'User updated successfully', 'user'=> $vicommUser],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::findOrFail($id);

        $User->delete();

        return response()->json(['success' => 'User deleted successfully'],Response::HTTP_OK);
    }
}
