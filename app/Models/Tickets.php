<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $fillable = [
    'CarNumber',
    'Paid'
];

    use HasFactory;
}
