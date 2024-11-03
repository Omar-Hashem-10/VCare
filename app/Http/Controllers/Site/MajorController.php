<?php

namespace App\Http\Controllers\Site;

use App\Models\About;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MajorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $majors = Major::paginate(8);
        $abouts = About::get();
        return view('web.site.pages.majors.index', compact('majors', 'abouts'));
    }
}
