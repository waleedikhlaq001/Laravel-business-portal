<?php

namespace App\Http\Controllers\api\v1;


use App\Models\Skill;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class SkillController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->ajax() ? Skill::paginate(50) : abort(404);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, $data)
    {
        return $request->ajax() ? Skill::where('name', 'like', "%{$data}%")
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
            "skill" => ['required', 'string', 'unique:skills,skill'],                       
        ]);
     
        Skill::create($request->all());

        return response()->json(['success' => 'Skill created successfully'],Response::HTTP_OK);
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
            'skill' => 'required|string',
        ]);

        $vicommSkill = Skill::findOrFail($id);

        $vicommSkill->update($request->all());

        return response()->json(['success' => 'Skill updated successfully', 'skill'=> $vicommSkill],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Skill = Skill::findOrFail($id);

        $Skill->delete();

        return response()->json(['success' => 'Skill deleted successfully'],Response::HTTP_OK);
    }
}
