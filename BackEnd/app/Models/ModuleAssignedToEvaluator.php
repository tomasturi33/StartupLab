<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleAssignedToEvaluator extends Model
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

    public function module_pre_incubation()
    {
        return $this->belongsTo(ModulePreIncubation::class);
    }
}
