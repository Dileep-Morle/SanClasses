<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    public function user(){
        return $this->belongsTo(user::class);
    }
    public function searchResult($search)
    {
    $query = DB::table("posts") ->where('title', 'LIKE', '%'.$search.'%')->get();
    return $query;
    }
}
