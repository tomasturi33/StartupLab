<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicUnit extends Model
{
    use HasFactory;

    public function careers()
    {
        return $this->hasMany(Career::class)->orderBy('name', 'ASC');
    }
}
