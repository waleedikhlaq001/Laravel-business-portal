<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Job;
use App\Models\User;
use App\Models\Team;
use App\Models\Product;
use App\Models\Vendor;
use App\Notifications\AmbApproved;
use App\Notifications\WithApproved;
use Mail;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard', [
            'users' => User::count(),
            'jobs' => Job::count(),
            'products' => Product::count(),
            'vendors' => Vendor::count(),
        ]);
    }
    public function users()
    {
        return view('admin.users.index');
    }
    public function categories()
    {
        return view('admin.categories.index');
    }
    public function support(Request $request)
    {
        if($request->type){
            if($request->type == "open"){
                $tickets = DB::table("support_tickets")->where("status", "open")->paginate(50);
            }
            elseif($request->type == "closed"){
                $tickets = DB::table("support_tickets")->where("status", "closed")->paginate(50);
            }else{
                return redirect("/admin/support");
            }
        }else{

        $tickets = DB::table("support_tickets")->paginate(50);
        }
        $open = DB::table("support_tickets")->where("status", "open")->count();
        $closed = DB::table("support_tickets")->where("status", "closed")->count();
        $all = DB::table("support_tickets")->count();
        return view('admin.support.index', compact("all", "open", "closed", "tickets"));
    }

    public function support_ticket(Request $request, $id)
    {
        if(DB::table("support_tickets")->where("id", $id)->exists()){
        $ticket = DB::table("support_tickets")->where("id", $id)->first();
        $messages = DB::table("support_ticket_messages")->where("support_ticket_id", $id)->orderBy("id", "DESC")->get();
        $user = DB::table("users")->where("id", $ticket->user_id)->first();
        }else{

        return redirect("/admin/support");
        }
        return view('admin.support.ticket', compact("messages", "ticket", "user"));
    }
    public function products()
    {
        return view('admin.products.index');
    }
    
    public function skills()
    {
        return view('admin.skills.index');
    }
    public function residules()
    {
        return view('admin.residules.index');
    }
    public function cms()
    {
        return view('admin.cms.index');
    }
    public function team()
    {
        $team = Team::all();
        return view('admin.cms.team', compact('team'));
    }
    public function ambassadors()
    {
        $users = DB::table("ambassadors")->orderBy("id", "DESC")->get();
        return view('admin.ambassadors.index', compact('users'));
    }
    public function vendor_contacts()
    {
        $users = DB::table("vendor_contacts")->orderBy("id", "DESC")->get();
        return view('admin.vendor_contacts.index', compact('users'));
    }
    public function ambassador_notifications()
    {
        $data = DB::table("ambassador_notifications")->orderBy("id", "DESC")->get();
        return view('admin.ambassadors.notifications', compact('data'));
    }

    public function downloadcsv()
    {
        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=users.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];
    
        $list = User::all()->toArray();
    
        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));
    
       $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
    
        return response()->stream($callback, 200, $headers);
    }
    public function ambassador($id)
    {
        $user = DB::table("ambassadors")->where("id", $id)->first();
        if(!$user){
            return redirect()->back();
        }
        return view('admin.ambassadors.user', compact('user'));
    }
    public function changestatus(Request $request){
        $status = $request->status;
        $user = DB::table("ambassadors")->where("id", $request->id)->first();
        DB::table("ambassadors")->where("id", $user->id)->update(["status"=>$status]);
        if($status == 1){
            $details = [
                'user' => $user->name,
                'message' => 'Thanks for registering with us. We at Vicomma are pleased to announce that your application as a vicomma ambassador has been approved. You can now sign in to your ambassador dashboard with your credentials.'
            ];
        $email = $user->email;
        Mail::to($email)->send(new AmbApproved($details));
        }
        return response()->json([
            'message'=>"Updated"
        ]);
    }

    public function changestatus2(Request $request){
        $status = $request->status;
        DB::table("ambassador_transactions")->where("id", $request->id)->update(["status"=>$status]);
        $tran = DB::table("ambassador_transactions")->where("id", $request->id)->first();
        $user = DB::table("ambassadors")->where("id", $tran->user_id)->first();

        if($status == "approved"){
            $details = [
                'user' => $user->name,
                'message' => 'Your withdrawal of NGN'.number_format($tran->amount, 2).' was processed successfully.'
            ];
        $email = $user->email;
        Mail::to($email)->send(new WithApproved($details));
        }
        if($status == "rejected"){
            DB::table("ambassadors_transactions")->where("id", $tran->id)->increment('amount', $tran->amount);
        }
        return response()->json([
            'message'=>"Updated"
        ]);
    }

    public function addNotification(Request $request){
        $title = $request->title;
        $body = $request->body;
        DB::table("ambassador_notifications")->insert([
            "title"=>$title,
            "text"=>$body
        ]);
        return response()->json(['message'=>"Notification added"]);
    }    
    public function removeNotification($id){
        DB::table("ambassador_notifications")->where("id", $id)->delete();
        return redirect("/admin/ambassadors/notifications");
    }

    public function addTeam(Request $request)
    {
        $name = $request->c_name;
        $position = $request->position;
        $hierachy = $request->hierachy;
        $fb = $request->fb;
        $tw = $request->tw;
        $insta = $request->insta;

        $file = $request->file('pic');

        //Display File Name
        //   $file->getClientOriginalName();

        //Display File Extension
        $ext = $file->getClientOriginalExtension();

        if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif"){

            echo '<script>alert("Sorry, only JPG, JPEG, PNG and GIF images are allowed!!!")</script>';
            return redirect()->back();

        }

        $file_name = strtolower(str_replace(" ","-",$name)).rand().".".$ext;

        // $size = $file->getSize();

        // if($size > 20000000){
        //     echo '<script>alert("Image file size is more than 2mb!")</script>';
        //     return redirect()->back();
        // }

        //Display File Mime Type
        //   echo 'File Mime Type: '.$file->getMimeType();

        //Move Uploaded File
        $team_path =  $request->file('pic')->store('team-img', 's3', $file_name);

        if(Storage::disk('s3')->setVisibility($team_path, 'public')){

            $team = new Team;
            $team->name = $name;
            $team->image = Storage::disk('s3')->url($team_path);
            $team->position = $position;
            $team->hierachy = $hierachy;
            $team->fb_link = $fb;
            $team->tw_link = $tw;
            $team->insta_link = $insta;

            if($team->save()){
                echo '<script>
                alert("Team member profile was saved successfully !");
                </script>';
                return redirect()->back();
            }else{

                echo '<script>alert("Ooops! Something went wrong. Try again!")</script>';
                return redirect()->back();

            }
        }
    }
    public function editTeam($t_id)
    {
        $team = Team::where('id',$t_id)->get();
        if(count($team) > 0){
            return view('admin.cms.editTeam', compact('team'));
        }else{
            echo '<script>alert("Invalid request!");</script>';
            return redirect()->back();
        }

    }
    public function saveTeamChanges(Request $request){
        $team = Team::find($request->id);
        $name = $request->c_name;
        $position = $request->position;
        $hierachy = $request->hierachy;
        $fb = $request->fb;
        $tw = $request->tw;
        $insta = $request->insta;

        if(!empty($request->file('pic'))){

            $file = $request->file('pic');

            //Display File Name
            //   $file->getClientOriginalName();

            //Display File Extension
            $ext = $file->getClientOriginalExtension();

            if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif"){

                echo '<script>alert("Sorry, only JPG, JPEG, PNG and GIF images are allowed!!!")</script>';
                return redirect()->back();

            }

            $file_name = strtolower(str_replace(" ","-",$name)).rand().".".$ext;

            //Display File Mime Type
            //   echo 'File Mime Type: '.$file->getMimeType();

            //Move Uploaded File
            $team_path =  $request->file('pic')->store('team-img', 's3', $file_name);

            if(Storage::disk('s3')->setVisibility($team_path, 'public')){

                $team->name = $name;
                $team->image = $file_name;
                $team->position = $position;
                $team->hierachy = $hierachy;
                $team->fb_link = $fb;
                $team->tw_link = $tw;
                $team->insta_link = $insta;

                if($team->save()){
                    echo '<script>
                    alert("Team member profile was saved successfully !");
                    </script>';
                    return redirect()->back();
                }else{

                    echo '<script>alert("Ooops! Something went wrong. Try again!")</script>';
                    return redirect()->back();

                }

            }
        }else{

            $team->name = $name;
            $team->position = $position;
            $team->hierachy = $hierachy;
            $team->fb_link = $fb;
            $team->tw_link = $tw;
            $team->insta_link = $insta;

            if($team->save()){
                echo '<script>
                alert("Team member profile was edited successfully !");
                </script>';
                return redirect()->back();
            }else{

                echo '<script>alert("Ooops! Something went wrong. Try again!")</script>';
                return redirect()->back();

            }
        }
    }
    public function deleteTeam($file)
    {
        // $link = asset("img/teams/".$file);
        // unlink($link);
        DB::delete("DELETE FROM teams WHERE id = ? LIMIT 1",[$file]);
        return redirect()->back();
    }
}
