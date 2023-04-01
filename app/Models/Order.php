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
        'extraTime',
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

    public function extraTime()
    {
        return $this->hasMany(ExtraTime::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($order) {
            $extraTime = new ExtraTime();
            $extraTime->order_id = $order->id;
            $extraTime->service_id = $order->service_id;
            $extraTime->summary_extra_time = $order->summary;
            $extraTime->save();
        });
    }
}
