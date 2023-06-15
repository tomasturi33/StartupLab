<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    /**
     * Get the provincia associated with the localidad.
     */
    public function academic_unit()
    {
        return $this->belongsTo(AcademicUnit::class);
    }
}
