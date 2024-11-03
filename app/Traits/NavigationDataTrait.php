<?php

namespace App\Traits;

use App\Models\Major;
use App\Models\Role;

trait NavigationDataTrait
{
    /**
     * Get navigation data for reuse in multiple controllers.
     */
    public function getNavigationData()
    {
        $majors_nav = Major::with('doctors')->get();
        $roles_nav = Role::get();
        return compact('majors_nav', 'roles_nav');
    }
}
