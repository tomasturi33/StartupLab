<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'finish_date',
        'published'
    ];

    public function module_pre_incubations()
    {
        return $this->hasMany(ModulePreIncubation::class)->orderBy('order', 'ASC');
    }

    public function entrepreneurship()
    {
        return $this->hasMany(Entrepreneurship::class)->orderBy('id', 'desc');
    }

    public function convocationForm()
    {
        return $this->hasMany(ConvocationForm::class);
    }
}
