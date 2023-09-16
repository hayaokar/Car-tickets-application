<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;
    protected $fillable=[
        'carNumber',
        'Driver',
        'Type',
        'Password',
        'activate'
        ];

    public function tickets(){
        return $this->hasMany('App\Models\Tickets','carNumber','carNumber');
    }

}
