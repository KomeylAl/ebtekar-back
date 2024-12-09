<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_numbers', 'address', 'email', 'bg_path','logo_path','company_name','description'
    ];
}
