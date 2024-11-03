<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Major;
use App\Traits\NavigationDataTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    use NavigationDataTrait;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.dashboard.index', $navigationData);
    }
}
