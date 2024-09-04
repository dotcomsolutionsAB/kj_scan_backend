<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScansModel extends Model
{
    use HasFactory;

    protected $table = 't_scans';

    protected $fillable = [
        'event_id',
        'its',
        'entered_by',
        // 'memeneen_name',
        // 'memeneen_gender',
        'gender',
    ];
}
