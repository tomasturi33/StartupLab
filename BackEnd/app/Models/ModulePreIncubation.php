<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePreIncubation extends Model
{
    use HasFactory;

    public function pills()
    {
        return $this->hasMany(Pill::class)->orderBy('order', 'ASC');
    }
}
