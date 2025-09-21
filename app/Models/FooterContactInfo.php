<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterContactInfo extends Model
{
    protected $fillable = [
        'address', 'phone', 'email'
    ];

}
