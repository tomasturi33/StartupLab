<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepreneurshipWindow extends Model
{
    use HasFactory;

    /**
     * Get the provincia associated with the provincias.
     */
    public function convocation_form()
    {
        return $this->belongsTo(ConvocationForm::class);
    }
}
