<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePreIncubationTask extends Model
{
    use HasFactory;

    public function module_pre_incubation()
    {
        return $this->belongsTo(ModulePreIncubation::class);
    }

    public function entrepreneurship()
    {
        return $this->belongsTo(Entrepreneurship::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
