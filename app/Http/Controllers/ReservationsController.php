<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationRoom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservationsController extends Controller
{
    public function roomTypes(): JsonResponse
    {
        return response()->json(ReservationRoom::with('timeRange')->get()->keyBy('name'));
    }

    public function reservations(Request $request): JsonResponse
    {
        if ($request->has('type')) {
            $strDate = $request->get('date');
            $date = Carbon::createFromFormat('Y-m-d', $strDate)->setHour(0);
            $dateFormat = $date->format('Y-m-d H:i:s.u');
            $nextDateFormat = $date->addDays(1)->format('Y-m-d H:i:s.u');

            return response()->json(Reservation::where('room_name', $request->type)
                ->where('start_date', '>=', $dateFormat)
                ->where('start_date', '<=', $nextDateFormat)
                ->get());
        }
        if ($request->has('userId')) {
            return response()->json(Reservation::where('user_id', $request->userId)->get());
        }
        return response()->json(['message' => 'bad request'], 400);
    }

    public function newReservation(Request $request): JsonResponse
    {
        $reservation = Reservation::create([
            'user_id' => $request->input('userId'),
            'start_date' => $request->input('startDate'),
            'room_name' => $request->input('type'),
        ]);

        return response()->json($reservation);
    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return response()->json(['message' => 'deleted']);
    }
}
