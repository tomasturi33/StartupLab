<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PillTeacher extends Model
{
    use HasFactory;

    public function pill()
    {
        return $this->hasMany(Pill::class);
    }
}
