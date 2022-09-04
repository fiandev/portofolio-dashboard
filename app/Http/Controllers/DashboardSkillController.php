<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;

class DashboardSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $skills = Skill::where("user_id", auth()->user()->id)
        ->paginate(10);
        return view("dashboard.skills.index", [
            "skills" => $skills
          ]);
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
    private function checkLevel($percen) {
      $percentage = (int) $percen;
      $level = "beginner";
      if ($percentage > 40) {
          $level = "intermediate";
        }
        
      if($percentage > 80) {
        $level = "expert";
      }
      
      return $level;
    }
    
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => "required|max:255|min:3",
            "percentage" => "required",
            "description" => "",
          ]);
        /* level */
        $percentage = (int) $validate["percentage"];
        $level = $this->checkLevel($percentage);
        
        $validate["level"] = $level;
        $validate["user_id"] = auth()->user()->id;
        $validate["uid"] = uniqid();
        Skill::create($validate);
        return back()->with("success", "new skill has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return view("dashboard.skills.edit", [
            "skill" => $skill,
          ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
      $rules = [];
      if ($request->name === $skill->name && $request->uid === $skill->uid && $request->description === $skill->description && $request->percentage === $skill->percentage ) {
        return redirect("/skills")->with("info", "nothing updated, skill named ". $skill->name ." has up to date!");
      }
      if ($request->name != $skill->name) {
        $rules["name"] = "required|min:3|max:255";
      }
      if ($request->uid != $skill->uid) {
        $rules["uid"] = "required|min:3|max:255|unique:skills";
      }
      if ($request->description != $skill->description) {
        $rules["description"] = "required|min:3|max:255";
      }
      if ($request->percentage != $skill->percentage) {
        $rules["percentage"] = "required|min:1|max:100";
      }
      
      $validate = $request->validate($rules);
      
      $validate["level"] = $this->checkLevel($request->percentage);
      
      /* update data */
      Skill::where("id", $skill->id)->update($validate);
      
      return redirect("/skills")->with("success", "skill named ". $skill->name ." has updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        Skill::destroy($skill->id);
        
        return back()->with("success", "success deleted skill ". $skill->name );
    }
}
