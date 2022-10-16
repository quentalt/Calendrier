<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'reason',
        'begin',
        'start',
        'end',
        'session',
        'booked_by',
        'user_id',
    ];
    /**
     * @Route("Route", name="RouteName")
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
