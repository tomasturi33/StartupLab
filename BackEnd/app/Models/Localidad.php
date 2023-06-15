<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    /**
     * Get the provincia associated with the localidad.
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
}
