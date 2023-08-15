<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Frontend;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Image;

class GeneralSettingController extends Controller {
    public function index() {
        $pageTitle = 'Cài đặt';
        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        return view('admin.setting.general', compact('pageTitle', 'timezones'));
    }

    public function update(Request $request) {
        $request->validate([
            'site_name'                => 'required',
            'cur_text'                 => 'required',
            'cur_sym'                  => 'required',
            'tax'                      => 'required|numeric|min:0',
            'tax_name'                 => 'required|max:40',
            'base_color'               => 'nullable', 'regex:/^[a-f0-9]{6}$/i',
            'timezone'                 => 'required',
            'checkin_time'             => 'required|date_format:H:i',
            'checkout_time'            => 'required|date_format:H:i',
            'upcoming_checkin_days'    => 'required|numeric|min:1',
            'upcoming_checkout_days'   => 'required|numeric|min:1'
        ]);

        $general                           = gs();
        $general->site_name                = $request->site_name;
        $general->cur_text                 = $request->cur_text;
        $general->cur_sym                  = $request->cur_sym;
        $general->tax                      = $request->tax;
        $general->tax_name                 = $request->tax_name;
        $general->base_color               = str_replace('#', '', $request->base_color);
        $general->checkin_time             = $request->checkin_time;
        $general->checkout_time            = $request->checkout_time;
        $general->upcoming_checkin_days    = $request->upcoming_checkin_days;
        $general->upcoming_checkout_days   = $request->upcoming_checkout_days;

        $general->save();

        $timezoneFile = config_path('timezone.php');
        $content = '<?php $timezone = ' . $request->timezone . ' ?>';
        file_put_contents($timezoneFile, $content);
        $notify[] = ['success', 'Cài đặt chung cập nhật thành công'];
        return back()->withNotify($notify);
    }
    public function logoIcon() {
        $pageTitle = 'Logo & Favicon';
        return view('admin.setting.logo_icon', compact('pageTitle'));
    }

    public function logoIconUpdate(Request $request) {
        $request->validate([
            'logo'    => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'favicon' => ['image', new FileTypeValidate(['png'])],
        ]);
        if ($request->hasFile('logo')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo)->save($path . '/logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the logo'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $path = getFilePath('logoIcon');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $size = explode('x', getFileSize('favicon'));
                Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the favicon'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Logo & favicon updated successfully'];
        return back()->withNotify($notify);
    }
}
