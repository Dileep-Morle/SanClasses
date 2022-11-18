<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Bertvthul\Cropper\HasCropper;

class Team extends Model
{
    use HasFactory, SoftDeletes, HasCropper;
    public static $cropper = [
        'avatar' => [
            'validation' => [
                'required' => true,
            ],
            'width' => 200,
            'height' => 200,
        ],
    ];
}
