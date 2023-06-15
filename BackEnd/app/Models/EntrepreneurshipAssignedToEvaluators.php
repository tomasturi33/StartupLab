<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepreneurshipAssignedToEvaluators extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function edition()
    {
        return $this->belongsTo(Edition::class);
    }

    public function entrepreneurship()
    {
        return $this->belongsTo(Entrepreneurship::class, 'entrep_id')->select(['id', 'title']);
    }
}
