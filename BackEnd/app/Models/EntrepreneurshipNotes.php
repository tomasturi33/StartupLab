<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepreneurshipNotes extends Model
{
    use HasFactory;

    public function entrepreneurship()
    {
        return $this->belongsTo(Entrepreneurship::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('name', 'lastname');
    }
}
