<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = []; //all column become fillable

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
        //    return false;
        dd($model->time_book);
           return true;
        });
    }
}
