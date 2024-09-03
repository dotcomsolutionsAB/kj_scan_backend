<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MumeneenModel extends Model
{
    use HasFactory;

    protected $table = 't_mumeneen';

    protected $fillable = [
        'its',
        'name',
        'mobile',
        'gender',
        'age',
        'arabic_name',
    ];
}
