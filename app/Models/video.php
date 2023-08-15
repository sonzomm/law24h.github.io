<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class video extends Model
{
    use HasFactory;
    use GlobalStatus;


    public  function index(){
        $video = DB::table('videos') -> get();
        return $video;
    }
    public  function  store($video)
    {
        DB::table('videos')->insert([
            'name' => $video -> name,
            'noidung' => $video->noidung,
            'video' => $video->video,
            'feature_status' => $video->feature_status
        ]);
    }
    public  function  destroyer($video)
    {
        DB::table('videos')->delete($video->id);
    }
    public function edit($video){
        DB::table('videos')->where('id','=',$video->id)-> update([
            'name' => $video -> name,
            'noidung' => $video->noidung,
            'video' => $video->video,
            'feature_status' => $video->feature_status
        ]);
    }


    public function scopeFeatured($query) {
        return $query->where('feature_status', Status::ROOM_TYPE_FEATURED);
    }

    public function featureBadge(): Attribute {
        return new Attribute(
            function () {
                $html = '';
                if ($this->feature_status == Status::ROOM_TYPE_FEATURED) {
                    $html = '<span class="badge badge--primary">' . trans('Featured') . '</span>';
                } else {
                    $html = '<span><span class="badge badge--dark">' . trans('Unfeatured') . '</span></span>';
                }

                return $html;
            }
        );
    }


}
