<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\NotificationTemplate;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function global(){
        $pageTitle = 'thông báo';
        return view('admin.notification.global_template',compact('pageTitle'));
    }

    public function globalUpdate(Request $request){
        $request->validate([
            'email_from' => 'required|email|string|max:40',
            'email_template' => 'required',
        ]);

        $general = gs();
        $general->email_from = $request->email_from;
        $general->email_template = $request->email_template;
        $general->save();

        $notify[] = ['success','Cài đặt được cập nhật thành công'];
        return back()->withNotify($notify);
    }

    public function templates(){
        $pageTitle = 'Thông báo';
        $templates = NotificationTemplate::orderBy('name')->get();
        return view('admin.notification.templates',compact('pageTitle','templates'));
    }

    public function templateEdit($id)
    {
        $template = NotificationTemplate::findOrFail($id);
        $pageTitle = $template->name;
        return view('admin.notification.edit', compact('pageTitle', 'template'));
    }

    public function templateUpdate(Request $request,$id){
        $request->validate([
            'subject' => 'required|string|max:255',
            'email_body' => 'required'
        ]);
        $template = NotificationTemplate::findOrFail($id);
        $template->subj = $request->subject;
        $template->email_body = $request->email_body;
        $template->email_status = $request->email_status ? Status::ENABLE : Status::DISABLE;
        $template->save();
        $notify[] = ['success','Thành công'];
        return back()->withNotify($notify);
    }

    public function emailSetting(){
        $pageTitle = 'Cài dặt Email thành công';
        return view('admin.notification.email_setting', compact('pageTitle'));
    }

    public function emailSettingUpdate(Request $request)
    {
        $request->validate([
            'email_method' => 'required|in:php,smtp,sendgrid,mailjet',
            'host' => 'required_if:email_method,smtp',
            'port' => 'required_if:email_method,smtp',
            'username' => 'required_if:email_method,smtp',
            'password' => 'required_if:email_method,smtp',
            'enc' => 'required_if:email_method,smtp',
            'appkey' => 'required_if:email_method,sendgrid',
            'public_key' => 'required_if:email_method,mailjet',
            'secret_key' => 'required_if:email_method,mailjet',
        ], [
            'host.required_if' => ':attribute is required for SMTP configuration',
            'port.required_if' => ':attribute is required for SMTP configuration',
            'username.required_if' => ':attribute is required for SMTP configuration',
            'password.required_if' => ':attribute is required for SMTP configuration',
            'enc.required_if' => ':attribute is required for SMTP configuration',
            'appkey.required_if' => ':attribute is required for SendGrid configuration',
            'public_key.required_if' => ':attribute is required for Mailjet configuration',
            'secret_key.required_if' => ':attribute is required for Mailjet configuration',
        ]);
        if ($request->email_method == 'php') {
            $data['name'] = 'php';
        } else if ($request->email_method == 'smtp') {
            $request->merge(['name' => 'smtp']);
            $data = $request->only('name', 'host', 'port', 'enc', 'username', 'password', 'driver');
        } else if ($request->email_method == 'sendgrid') {
            $request->merge(['name' => 'sendgrid']);
            $data = $request->only('name', 'appkey');
        } else if ($request->email_method == 'mailjet') {
            $request->merge(['name' => 'mailjet']);
            $data = $request->only('name', 'public_key', 'secret_key');
        }
        $general = gs();
        $general->mail_config = $data;
        $general->save();
        $notify[] = ['success', 'Cài đặt email được cập nhật thành công'];
        return back()->withNotify($notify);
    }

    public function emailTest(Request $request){
        $request->validate([
           'email' => 'required|email'
       ]);

       $general = gs();
       $config = $general->mail_config;
       $receiverName = explode('@', $request->email)[0];
       $subject = strtoupper($config->name).'Cấu hình thành công';
       $message = 'Cài đặt thông báo qua email của bạn được định cấu hình thành công cho '.$general->site_name;

       if ($general->en) {
           $user = [
               'username'=>$request->email,
               'email'=>$request->email,
               'fullname'=>$receiverName,
           ];
           notify($user,'DEFAULT',[
               'subject'=>$subject,
               'message'=>$message,
           ],['email'],false);
       }else{
           $notify[] = ['info', 'Vui lòng bật từ cài đặt chung'];
           $notify[] = ['error', 'Thông báo qua email của bạn bị tắt'];
           return back()->withNotify($notify);
       }
       if (session('mail_error')) {
           $notify[] = ['error', session('mail_error')];
       }else{
           $notify[] = ['success', 'Email gửi đến '.$request->email.'thành công'];
       }
       return back()->withNotify($notify);
   }

}
