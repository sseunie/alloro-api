<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationsController extends Controller
{
    public function getNotifications()
    {
        return response()->json(Notification::all());
    }
}
