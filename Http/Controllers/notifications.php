<?php

namespace App\Http\Controllers;

use App\Models\notifications as ModelsNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class notifications extends Controller
{
    public function liste_notification_non_lu(){
        $notifications = ModelsNotifications::where('id_societe', Auth::user()->id)->where('statut','unread')->get();
        return response()->json(["message" =>$notifications,"total_notification"=>$notifications->count()]);
    }


    public function tout_marquer_lu(){
        $notifications = ModelsNotifications::where('id_societe', Auth::user()->id)
            ->where('statut','unread')
            ->update(["statut"=>"read"]);
        return response()->json(["message" =>"notification lu"]);
    }
}
