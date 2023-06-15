<?php

namespace App\Traits;

use App\Models\Entrepreneurship;
use App\Models\ModulePreIncubationTask;
use App\Models\ModulePreIncubation;

use Exception;

trait EntrepreneurshipTrait
{
    public function calculateProgress(Entrepreneurship $entrepreneurship)
    {
        $tasks_approved_count = ModulePreIncubationTask::where('entrepreneurship_id', $entrepreneurship->id)
                                                                        ->where('condition','approved')
                                                                        ->count();

        $module_pre_incubation_count = ModulePreIncubation::where('edition_id', $entrepreneurship->edition_id)
                                    ->where('state', 1)
                                    ->count();

        // if ($module_pre_incubation_count==0) {
        //     throw new Exception('Division by zero.');
        // }

        $progress = 0;
        if($module_pre_incubation_count!=0){
            $progress = round($tasks_approved_count/$module_pre_incubation_count*100, 2);
        }
        

        return $progress;
    }
}