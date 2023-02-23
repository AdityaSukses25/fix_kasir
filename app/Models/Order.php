<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = [
        'reception',
        'service',
        'therapist',
        'place',
        'discount',
    ];

    public function reception()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function therapist()
    {
        return $this->belongsTo(Therapist::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
