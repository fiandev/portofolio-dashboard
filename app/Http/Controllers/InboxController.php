<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inbox;

class InboxController extends Controller
{
    public function index () {
      $user = auth()->user();
      return view("dashboard.inbox.index", [
        "inboxes" => $user->inboxes
      ]);
    }
    
    public function show (Inbox $inbox) {
      if ($inbox->author->id !== auth()->user()->id) return redirect("/inbox");
      
      if (!$inbox->hasRead) {
        Inbox::whereId($inbox->id)
          ->update(["hasRead" => true]);
      }
      return view("dashboard.inbox.show", [
        "inbox" => $inbox
      ]);
    }
    
    public function deleteAll() {
      $user = auth()->user();
      Inbox::where("user_id", $user->id)
        ->delete();
        
      return back()->with("success", "all inbox successfully deleted!");
    }
    
    public function markAll() {
      $user = auth()->user();
      Inbox::where("user_id", $user->id)
        ->update(["hasRead" => true]);
      
      return back()->with("success", "marked all inbox as has been read!");
    }
    
    public function destroy(Inbox $inbox) {
      Inbox::destroy($inbox->id);
      
      return redirect("/inbox")->with("success", "an inbox has been delete!");
    }
}
