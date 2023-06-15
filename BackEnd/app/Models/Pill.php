<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pill extends Model
{
    use HasFactory;

    public function pill_teacher()
    {
        return $this->hasOne(PillTeacher::class);
    }

    public function module_pre_incubation()
    {
        return $this->hasMany(ModulePreIncubation::class);
    }
}
