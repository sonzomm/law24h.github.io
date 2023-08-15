<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use App\Models\BookedRoom;
use App\Models\Booking;
use App\Models\PaymentLog;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Constants\Status;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {

    public function dashboard() {

        $pageTitle                          = 'Dashboard';
        $todaysBookedRoomIds                = BookedRoom::active()->where('booked_for', todaysDate())->pluck('room_id')->toArray();
        $widget['today_booked']             = count($todaysBookedRoomIds);
        $widget['today_available']          = Room::active()->whereNotIn('id', $todaysBookedRoomIds)->count();
        $widget['total']                    = Booking::count();
        $widget['active']                   = Booking::active()->count();
        $widget['pending_checkin']          = Booking::active()->KeyNotGiven()->whereDate('check_in', '<=', now())->count();
        $widget['delayed_checkout']         = Booking::delayedCheckout()->count();
        $widget['upcoming_checkin']         = Booking::active()->whereDate('check_in', '>', now())->whereDate('check_in', '<=', now()->addDays(gs('upcoming_checkin_days')))->count();
        $widget['upcoming_checkout']        = Booking::active()->whereDate('check_out', '>', now())->whereDate('check_out', '<=', now()->addDays(gs('upcoming_checkout_days')))->count();
        $widget['total_users']              = User::count();
        $widget['verified_users']           = User::active()->count();
        $widget['email_unverified_users']   = User::emailUnverified()->count();
        $report['months']                = collect([]);
        $report['booking_month_amount']  = collect([]);
        $report['booking_cancel_amount'] = collect([]);

        $bookingMonth  = BookedRoom::where('booked_for', '>=', now()->subYear())
            ->whereIn('status', [Status::ROOM_ACTIVE, Status::ROOM_CHECKOUT])
            ->selectRaw("SUM( CASE WHEN status IN(1,9) THEN fare END) as bookingAmount")
            ->selectRaw("DATE_FORMAT(booked_for,'%M-%Y') as months")
            ->orderBy('created_at')
            ->groupBy('months')
            ->get();


        $bookingMonth->map(function ($bookingData) use ($report) {
            $report['months']->push($bookingData->months);
            $report['booking_month_amount']->push(getAmount($bookingData->bookingAmount));
        });

        $trxReport['date'] = collect([]);

        $plusTrx = PaymentLog::where('type', 'RECEIVED')->where('created_at', '>=', now()->subDays(30))
            ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at,'%Y-%m-%d') as date")
            ->orderBy('created_at')
            ->groupBy('date')
            ->get();

        $plusTrx->map(function ($trxData) use ($trxReport) {
            $trxReport['date']->push($trxData->date);
        });

        $minusTrx = PaymentLog::where('type', 'RETURNED')->where('created_at', '>=', now()->subDays(30))
            ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at,'%Y-%m-%d') as date")
            ->orderBy('created_at')
            ->groupBy('date')
            ->get();

        $minusTrx->map(function ($trxData) use ($trxReport) {
            $trxReport['date']->push($trxData->date);
        });

        $trxReport['date'] = dateSorting($trxReport['date']->unique()->toArray());
        $months            = $report['months'];

        for ($i = 0; $i < $months->count(); ++$i) {
            $monthVal  = Carbon::parse($months[$i]);
            if (isset($months[$i + 1])) {
                $monthValNext = Carbon::parse($months[$i + 1]);
                if ($monthValNext < $monthVal) {
                    $temp = $months[$i];
                    $months[$i]   = Carbon::parse($months[$i + 1])->format('F-Y');
                    $months[$i + 1] = Carbon::parse($temp)->format('F-Y');
                } else {
                    $months[$i]   = Carbon::parse($months[$i])->format('F-Y');
                }
            }
        }

        return view('admin.dashboard', compact('pageTitle', 'widget','bookingMonth', 'months', 'trxReport', 'plusTrx', 'minusTrx'));
    }


    public function profile() {
        $pageTitle = 'Profile';
        $admin = auth('admin')->user();
        return view('admin.profile', compact('pageTitle', 'admin'));
    }

    public function profileUpdate(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])]
        ]);
        $user = auth('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = fileUploader($request->image, getFilePath('adminProfile'), getFileSize('adminProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Không thể tải lên hình ảnh của bạn'];
                return back()->withNotify($notify);
            }
        }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Profile được cập nhật thành công'];
        return to_route('admin.profile')->withNotify($notify);
    }


    public function password() {
        $pageTitle = 'Password';
        $admin = auth('admin')->user();
        return view('admin.password', compact('pageTitle', 'admin'));
    }

    public function passwordUpdate(Request $request) {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = auth('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Mật khẩu không khớp'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Mật khẩu đã thay đổi thành công.'];
        return to_route('admin.password')->withNotify($notify);
    }


    public function downloadAttachment($fileHash) {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $title = slug(gs('site_name')) . '- attachments.' . $extension;
        $mimetype = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }
}
