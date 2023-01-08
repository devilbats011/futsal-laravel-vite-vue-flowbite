<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $guarded = []; //all column become fillable

    public function court()
    {
        return $this->belongsTo(Court::class);
        // return $this->belongsTo(Court::class,'court_id','id');
    }

    //? lowercase noun not plural
    //? https://www.itsolutionstuff.com/post/laravel-one-to-one-eloquent-relationship-tutorialexample.html
    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
           $model->book_number = mt_rand(1000, 9999)."-".strtoupper(Str::random(4));
           return true;
        });

    }
}
