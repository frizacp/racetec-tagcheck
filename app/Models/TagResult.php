<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagResult extends Model
{
    use HasFactory;
    protected $table = 'racetecresult';
    protected $primaryKey = 'id';
    public $incrementing = false; // karena kita isi manual
    protected $keyType = 'int';   // kalau id angka, ganti 'string' kalau bukan

    public static function getTagCheck($data)
    {
        $tag              = TagResult::where('id', $data['id'])->first() ?? new TagResult;
        $tag->id          = $data['id'];
        $tag->bib         = $data['bib'];
        $tag->firstname   = $data['firstname'];
        $tag->lastname    = $data['lastname'];
        $tag->gender      = $data['gender'];
        $tag->type        = $data['type'];
        $tag->dob         = $data['dob'];
        $tag->age         = $data['age'];
        $tag->contest     = $data['contest'];
        $tag->category    = $data['category'];
        $tag->race        = $data['race'];
        $tag->chipcode    = $data['chipcode'];
        $tag->finishclock = $data['finishclock'];
        $tag->starttime   = $data['starttime'];
        $tag->finishtime  = $data['finishtime'];
        $tag->chiptime    = $data['chiptime'];
        $tag->pace        = $data['pace'];
        $tag->created_at  = $data['created_at'];
        $tag->updated_at  = $data['updated_at'];
        $tag->save();
    }
}
