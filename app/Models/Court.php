<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function logCreate  ($event,$user) {
    //     $log = $this->create([
    //         'log' => "{$event} have been create by {$user}"
    //     ]);
    //     return $log;
    // }
}
