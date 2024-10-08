<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    use HasFactory;

    protected $table = 't_event';

    protected $fillable = [
        'event_name',
        'date',
        'status',
        'description',
    ];
}
