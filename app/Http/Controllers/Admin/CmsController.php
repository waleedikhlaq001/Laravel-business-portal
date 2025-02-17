<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cms;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function about()
    {
     $about = DB::table("cms")->where("type", "about")->first();
    //  return response()->json(compact('about'));
     return view("admin.cms.about", compact("about"));  
    }

     public function accepted()
    {
     $accepted = DB::table("cms")->where("type", "accepted")->first();
    //  return response()->json(compact('about'));
     return view("admin.cms.accept", compact("accepted"));  
    }
    public function vendor()
    {
     $about = DB::table("cms")->where("type", "vendor")->first();
    //  return response()->json(compact('about'));
     return view("admin.cms.vendorinfo", compact("about"));  
    }
    public function terms()
    {
     $about = DB::table("cms")->where("type", "terms")->first();
    //  return response()->json(compact('about'));
     return view("admin.cms.terms", compact("about"));  
    }
    public function privacy()
    {
     $about = DB::table("cms")->where("type", "privacy")->first();
    //  return response()->json(compact('about'));
     return view("admin.cms.privacy", compact("about"));  
    }
    public function online()
    {
     $about = DB::table("cms")->where("type", "online")->first();
    //  return response()->json(compact('about'));
     return view("admin.cms.onlinevideo", compact("about"));  
    }
    public function post_about(Request $request){
    $about = DB::table("cms")->where("type", "about")->first();
    $title = $request->title;
    $body = $request->body;
    if(!$about){
        DB::table("cms")->insert([
            "type"=>"about",
            "title"=>$title,
            "body"=>$body
        ]);
        return response()->json(["message"=>"Added"]);
    }        
    DB::table("cms")->where("id", $about->id)->update([
        "type"=>"about",
        "title"=>$title,
        "body"=>$body
    ]);
    return response()->json(["message"=>"Updated"]);
    }

    public function post_accepted(Request $request){
        $accepted = DB::table("cms")->where("type", "accepted")->first();
        $title = $request->title;
        $body = $request->body;
        if(!$accepted){
            DB::table("cms")->insert([
                "type"=>"accepted",
                "title"=>$title,
                "body"=>$body
            ]);
            return response()->json(["message"=>"Added"]);
        }        
        DB::table("cms")->where("id", $accepted->id)->update([
            "type"=>"accepted",
            "title"=>$title,
            "body"=>$body
        ]);
        return response()->json(["message"=>"Updated"]);
        }
    public function post_privacy(Request $request){
        $about = DB::table("cms")->where("type", "privacy")->first();
        $title = $request->title;
        $body = $request->body;
        if(!$about){
            DB::table("cms")->insert([
                "type"=>"privacy",
                "title"=>$title,
                "body"=>$body
            ]);
            return response()->json(["message"=>"Added"]);
        }        
        DB::table("cms")->where("id", $about->id)->update([
            "type"=>"privacy",
            "title"=>$title,
            "body"=>$body
        ]);
        return response()->json(["message"=>"Updated"]);
        }
        public function post_online(Request $request){
            $about = DB::table("cms")->where("type", "online")->first();
            $title = $request->title;
            $body = $request->body;
            if(!$about){
                DB::table("cms")->insert([
                    "type"=>"online",
                    "title"=>$title,
                    "body"=>$body
                ]);
                return response()->json(["message"=>"Added"]);
            }        
            DB::table("cms")->where("id", $about->id)->update([
                "type"=>"online",
                "title"=>$title,
                "body"=>$body
            ]);
            return response()->json(["message"=>"Updated"]);
            }
            public function post_vendor(Request $request){
                $about = DB::table("cms")->where("type", "vendor")->first();
                $title = $request->title;
                $body = $request->body;
                if(!$about){
                    DB::table("cms")->insert([
                        "type"=>"vendor",
                        "title"=>$title,
                        "body"=>$body
                    ]);
                    return response()->json(["message"=>"Added"]);
                }        
                DB::table("cms")->where("id", $about->id)->update([
                    "type"=>"vendor",
                    "title"=>$title,
                    "body"=>$body
                ]);
                return response()->json(["message"=>"Updated"]);
                }
                public function post_terms(Request $request){
                    $about = DB::table("cms")->where("type", "terms")->first();
                    $title = $request->title;
                    $body = $request->body;
                    if(!$about){
                        DB::table("cms")->insert([
                            "type"=>"terms",
                            "title"=>$title,
                            "body"=>$body
                        ]);
                        return response()->json(["message"=>"Added"]);
                    }        
                    DB::table("cms")->where("id", $about->id)->update([
                        "type"=>"terms",
                        "title"=>$title,
                        "body"=>$body
                    ]);
                    return response()->json(["message"=>"Updated"]);
                    }

}
