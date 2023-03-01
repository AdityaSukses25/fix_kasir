<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['gender'];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function presence()
    {
        return $this->hasMany(attendence::class);
    }
}
