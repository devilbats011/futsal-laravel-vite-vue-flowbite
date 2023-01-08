<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anonymous extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'anonymous';


    public function user() {
        return $this->belongsTo(User::class);
    }
}
