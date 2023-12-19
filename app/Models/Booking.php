<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ruangan_id',
        'start_book',
        'end_book',
        'approved_at',
    ];

    public function user(){
        return $this->belongsTo(User::class,  "user_id");
    }

    public function ruangan(){
        return $this->belongsTo(Ruangan::class, "ruangan_id");
    }

}
