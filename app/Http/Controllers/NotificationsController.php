<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\JsonResponse;

class NotificationsController extends Controller
{
    public function getNotifications(): JsonResponse
    {
        return response()->json(Notification::all());
    }
}
