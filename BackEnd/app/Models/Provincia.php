<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    public function localidads()
    {
        return $this->hasMany(Localidad::class)->orderBy('name', 'ASC');
    }
}
