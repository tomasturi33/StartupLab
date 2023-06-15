<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrepreneurship extends Model
{
    use HasFactory;

    /**
     * Get the provincia associated with the provincias.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the edition associated with the entrepreship.
     */
    public function convocation_form()
    {
        return $this->belongsTo(ConvocationForm::class);
    }

    /**
     * Get the edition associated with the entrepreship.
     */
    public function edition()
    {
        return $this->belongsTo(Edition::class);
    }

    /**
     * Get the provincia associated with the provincias.
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    /**
     * Get the localidad associated with the localidads.
     */
    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    /**
     * Get the entrepreneurship stadia associated with the entrepreneurship stadias.
     */
    public function entrepreneurship_stadia()
    {
        return $this->belongsTo(EntrepreneurshipStadium::class);
    }

    /**
     * Get the development degree associated with the development degrees.
     */
    public function development_degrees()
    {
        return $this->belongsTo(DevelopmentDegree::class);
    }

    /**
     * Get the vertical work associated with the vertical works.
     */
    public function vertical_works()
    {
        return $this->belongsTo(VerticalWorks::class);
    }

    /**
     * Get the vertical work associated with the vertical works.
     */
    public function need_startup()
    {
        return $this->hasMany(NeedStartup::class);
    }

    /**
     * Get the vertical work associated with the vertical works.
     */
    public function curriculum()
    {
        return $this->hasMany(CurriculumStartup::class);
    }

    /**
     * Get the vertical work associated with the vertical works.
     */
    // public function module_pre_incubation()
    // {
    //     return $this->hasMany(CurriculumStartup::class);
    // }

    public function module_pre_incubation_tasks()
    {
        return $this->hasMany(ModulePreIncubationTask::class);
    }

    /**
     * Get the notes associated with this.
     */
    public function entrepreneurship_notes()
    {
        return $this->hasMany(EntrepreneurshipNotes::class);
    }

}
