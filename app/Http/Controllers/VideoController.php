<?php

namespace App\Http\Controllers;

use App\Models\staff;
use App\Models\video;
use App\Http\Requests\StorevideoRequest;
use App\Http\Requests\UpdatevideoRequest;
use Illuminate\Support\Facades\Redirect;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = new video();
        $video = $videos->index();
        return view($this->activeTemplate.'sections.featured_room',['video'=>$video]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorevideoRequest $request , $id = 0)
    {
        if ($id) {
            $video         = video::findOrFail($id);
            $notification     = 'Video updated successfully';
        } else {
            $video         = new video();
            $notification     = 'Video added successfully';
        }
        $video -> name = $request -> name;
        $video -> noidung = $request -> noidung;
        $video->feature_status = $request->feature_status ? 1 : 0;
        if($request -> has('file_upload')){
            $file = $request -> file_upload;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('upload'),$file_name);
        }
        $request -> merge(['video' => $file_name]);
        $video["video"] = '/upload/'.$file_name;
        $video-> store($video);
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    /**
     * Display the specified resource.
     */
    public function show(video $video)
    {
        $videos = new video();
        $video = $videos->index();
        return view($this->activeTemplate.'video',['video'=>$video]);
    }

    public function faq(){
        return view($this->activeTemplate.'faq');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(video $video)
    {
        return view("admin.video.edit",['video'=> $video]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatevideoRequest $request, video $video)
    {
        $notification     = 'Video updated successfully';
        if($request -> has('file_upload')){
            $file = $request -> file_upload;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('upload'),$file_name);
        }
        $request -> merge(['video' => $file_name]);
        $video["video"] = '/upload/'.$file_name;
        $video -> name = $request -> name;
        $video -> noidung = $request -> noidung;
        $video->feature_status = $request->feature_status? 1 : 0;
//        dd($video);
        $video-> edit($video);
        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(video $video)
    {
        $video -> destroyer($video);
        return  Redirect::route('video.index');
    }
}
