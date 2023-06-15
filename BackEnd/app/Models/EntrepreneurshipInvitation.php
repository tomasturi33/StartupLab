<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepreneurshipInvitation extends Model
{
    use HasFactory;

    /**
     * Get the entrepreneurial profile associated with the localidad.
     */
    public function entrepreneurial_profile()
    {
        return $this->belongsTo(EntrepreneurialProfile::class);
    }
}
