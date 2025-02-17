<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\SupportTicketMessage;
use App\Models\User;
use App\Notifications\NewTicket;
use App\Notifications\NewTicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tickets = SupportTicket::where(['user_id' => $user->id])->get();

        return view('pages.user.support.index')->with(['tickets'=>$tickets]);
    }

    public function create()
    {
        return view('pages.user.support.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'subject' => 'required',
            'description' => 'required',
            'type' => 'required',
            'category' => 'required',
            'priority' => 'required',
        ]);

        $user = Auth::user();

        $ticket = new SupportTicket;
        $ticket->ticket_id = '#VST-'.rand(999, 10000).'-'.rand(9999, 100000);
        $ticket->user_id = $user->id;
        $ticket->initial_message = $request->description;
        $ticket->subject = $request->subject;
        $ticket->type = $request->type;
        $ticket->category = $request->category;
        $ticket->priority = $request->priority;

        $message = new SupportTicketMessage;
        $message->message = $request->description;
        $message->sender = $user->first_name.' '.$user->last_name;
        $message->user_id = $user->id;

        $ticket->save();
        $message->support_ticket_id = $ticket->id;
        $message->save();

        //mail sending

        // Send mail to vicomma admin
        $admin = User::where(['role'=>'admin'])->first();
        $details2 = [
            'url' => route('user.support.ticket.show', ['id'=>$ticket->ticket_id]),
            'user' => $admin->last_name . ' ' . $admin->first_name,
            'message' => 'A new ticket '.$ticket->title.' with ticket_id '.$ticket->ticket_id.' has been created; click on the button below to reply the ticket. You are getting this mail because you are a vicomma admin.'
        ];
        $admin->notify(new NewTicketMessage($details2));

        return redirect()->route('user.support.ticket');
    }

    public function show(Request $request){
        // dd($request->id);
        $ticket = SupportTicket::where('ticket_id', $request->id)->first();
        $messages = $ticket->supportTicketMessages()->paginate(5);
        return view('pages.user.support.show')->with(['ticket'=>$ticket, 'messages'=>$messages]);
    }

    public function reply(Request $request, $id){

        $this->validate($request, [
            'message' => 'required',
        ]);

        $date = date('Y-m-d H:i:s');
        $ticket = SupportTicket::find($id);
        $ticket->updated_at = $date;
        $ticket->status = 'open';
        $user = Auth::user();

        $message = new SupportTicketMessage;
        $message->message = $request->message;
        $message->sender = $user->first_name.' '.$user->last_name;
        $message->user_id = $user->id;

        $ticket->save();
        $message->support_ticket_id = $ticket->id;
        $message->save();

        //message sender is not the owner of the ticket then it's the admin.
        if($ticket->user_id = $user->id){
            // Send mail to vicomma admin
            $admin = User::where(['role'=>'admin'])->first();
            $details2 = [
                'url' => route('user.support.ticket.show', ['id'=>$ticket->ticket_id]),
                'user' => $admin->last_name . ' ' . $admin->first_name,
                'message' => 'A new ticket message was sent for the ticket '.$ticket->title.' with ticket_id '.$ticket->ticket_id.'; click on the button below to reply the ticket. You are getting this mail because you are a vicomma admin'
            ];
            $admin->notify(new NewTicketMessage($details2));

        }else{
            //send mail to owner of ticket
            $details = [
                'url' => route('user.support.ticket.show', ['id'=>$ticket->ticket_id]),
                'user' => $ticket->user->last_name . ' ' . $ticket->user->first_name,
                'message' => 'A TicketNewTicket process was started by the vendor for job '.$ticket->title.' with ticket_id '.$ticket->ticket_id.'; click on the button below to reply the Ticket.'
            ];
            $ticket->user->notify(new NewTicketMessage($details));
        }





        return redirect()->route('user.support.ticket.show', ['id'=>$ticket->ticket_id]);



    }

    public function close(Request $request){
        $ticket = SupportTicket::where('ticket_id', $request->id)->first();
        $ticket->status = 'closed';
        $ticket->save();
        return redirect()->back()->with('swal-success', 'Ticket closed successfully');
    }
}
