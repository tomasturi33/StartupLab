<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeaNeed extends Model
{
    use HasFactory;

    /**
     * Get the vertical work associated with the vertical works.
     */
    public function entrepreneurship_need()
    {
        return $this->belongsTo(EntrepreneurshipNeed::class);
    }

    
}
