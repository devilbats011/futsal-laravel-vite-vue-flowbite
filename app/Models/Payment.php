<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    protected $guarded = [];
    use HasFactory;

    //? noun not plural
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    //? https://laravel.com/docs/9.x/eloquent#events-using-closures
    protected static function booted()
    {
        static::updated(function ($model) {
            if (in_array($model->payment_status, ['counter', 'success'])) {
                // * book->state display to users about the Status/State of booking
                if ($model->book->state != 'booked')  $model->book->update(['state' => 'booked']);
            }
        });

        static::created(function ($model) {
            if (in_array($model->payment_status, ['counter', 'success'])) {
                $model->book->update(['state' => 'booked']);
            }
        });
    }
}
