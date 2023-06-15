<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepreneurialProfile extends Model
{
    use HasFactory;

    /**
     * Get the provincia associated with the Profile Entrepreneurial.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the provincia associated with the Profile Entrepreneurial.
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    /**
     * Get the localidad associated with the Profile Entrepreneurial.
     */
    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    /**
     * Get the completed studies associated with the Profile Entrepreneurial.
     */
    public function completed_studie()
    {
        return $this->belongsTo(CompletedStudies::class);
    }

    /**
     * Get the academic unit associated with the Profile Entrepreneurial.
     */
    public function academic_unit()
    {
        return $this->belongsTo(AcademicUnit::class);
    }

    /**
     * Get the career associated with the Profile Entrepreneurial.
     */
    public function career()
    {
        return $this->belongsTo(Career::class);
    }

     /**
     * Get the completed studies associated with the Profile Entrepreneurial.
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

         /**
     * Get the completed studies associated with the Profile Entrepreneurial.
     */
    public function convocation_form()
    {
        return $this->belongsTo(ConvocationForm::class);
    }
}
