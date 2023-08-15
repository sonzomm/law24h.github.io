<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;

class RoomController extends Controller {
    public function index() {
        $pageTitle = 'Danh sách phòng';
        $roomTypes = RoomType::get();

        $rooms = Room::searchable(['room_number', 'roomType:name'])->filter(['room_type_id'])->orderBy('room_number');

        if (request()->status == Status::ENABLE || request()->status == Status::DISABLE) {
            $rooms = $rooms->filter(['status']);
        }

        $rooms =  $rooms->with('roomType')->orderBy('room_number', 'asc')->paginate(getPaginate());

        return view('admin.hotel.room_list', compact('pageTitle', 'rooms', 'roomTypes'));
    }

    public function status($id) {
        return Room::changeStatus($id);
    }
}
