<?php

namespace App\Traits;

use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

trait BookingActions {
    private function getRooms(Request $request) {

        $checkIn = Carbon::parse($request->checkin_date);
        $checkOut = $request->checkout_date ? Carbon::parse($request->checkout_date) : $checkIn;
        $rooms = Room::active()
            ->where('room_type_id', $request->room_type)
            ->with([
                'booked' => function ($q) {
                    $q->active();
                },
                'roomType' => function ($q) {
                    $q->select('id', 'name', 'fare');
                }
            ])
            ->get();

        if (count($rooms) < $request->rooms) {
            return ['error' => ['Số lượng phòng yêu cầu không có sẵn cho ngày đã chọn']];
        }
        $numberOfRooms = $request->rooms;
        $requestUnitFare = $request->unit_fare;

        return view('partials.rooms', compact('checkIn', 'checkOut', 'rooms', 'numberOfRooms', 'requestUnitFare'))->render();
    }
}
