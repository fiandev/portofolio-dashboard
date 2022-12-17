<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $types = ["github", "facebook", "linkedin", "twitter", "instagram", "tiktok"];
    
    public function index()
    {  
        $links = Link::where("user_id", auth()->user()->id)->paginate(10);
        
        return view("dashboard.links.index", [
          "links" => $links,
          "types" => $this->types
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
    public function store(Request $request)
    {
        $validate = $request->validate([
            "type" => "required",
            "url" => "required"
          ]);
          
        /* check type url */
        if (!in_array($request->type, $this->types)) {
          return back()->with("error", "type url invalid");
        }
        
        $validate["user_id"] = auth()->user()->id;
        $validate["uid"] = uniqid();
        
        Link::create($validate);
        return back()->with("success", "new link has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        $types = $this->types;
        
        return view("dashboard.links.edit", [
            "link" => $link,
            "types" => $types,
          ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
      $rules = [];
      if ($request->type === $link->type && $request->uid === $link->uid && $request->url === $link->url ) {
        return back()->with("info", "nothing updated, link with uid". $link->uid ." has up to date!");
      }
      if ($request->type != $link->type) {
        /* check type url */
        if (!in_array($request->type, $this->types)) {
          return back()->with("error", "type url invalid");
        }
        $rules["type"] = "required|min:3|max:255";
      }
      if ($request->uid != $link->uid) {
        $rules["uid"] = "required|min:3|max:255|unique:links";
      }
      if ($request->url != $link->url) {
        $rules["url"] = "required|min:3|max:255";
      }
      
      $validate = $request->validate($rules);
      
      /* update data */
      Link::where("id", $link->id)->update($validate);
      
      return redirect("/links")->with("success", "link with uid ". $link->uid ." has updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        //
    }
}
