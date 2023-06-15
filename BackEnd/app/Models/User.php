<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function convocation_forms()
    {
        return $this->hasMany(ConvocationForm::class);
    }

    public function module_assigned_to_evaluator()
    {
        return $this->hasMany(ModuleAssignedToEvaluator::class);
    }

    public function entrepreneurship_assigned_to_evaluator()
    {
        return $this->hasMany(EntrepreneurshipAssignedToEvaluators::class);
    }

    public function entrepreneurship_assigned_to_tutor()
    {
        return $this->hasMany(EntrepreneurshipAssignedToTutor::class);
    }
}
