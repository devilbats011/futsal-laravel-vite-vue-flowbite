<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    // protected $hidden = ['book_number'];
    // private  $secretAdmin = '';
    protected $guarded = []; //all column become fillable

    public function court()
    {
        return $this->belongsTo(Court::class);
        // return $this->belongsTo(Court::class,'court_id','id');
    }

    // public function getBooksAdmin($secret) {
    //     $this->secretAdmin = $secret;
    //     return self::with(['court' => function ($query) {
    //         // $query;
    //         $query->select('id','number');
    //     }])
    //     ->paginate(20);

    // }

    // public function toArray()
    // {
    //     if ($this->secretAdmin) {
    //         $this->makeVisibbleBookNumber();
    //     }

    //     return parent::toArray();
    // }

    // public function makeVisibbleBookNumber()
    // {
    //     //  dd('??');
    //     return $this->makeVisible(['book_number']);
    // }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
        $model->book_number = mt_rand(1000, 9999)."-".strtoupper(Str::random(4));
           return true;
        });

    }
}
