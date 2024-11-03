<?php

namespace App\Http\Controllers\Site;

use App\Models\Download;
use App\Models\Info;
use App\Models\About;
use App\Models\Major;
use App\Models\Doctor;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $majors = Major::paginate(8);

        $doctors = Doctor::with('major')->get();

        $infos = Info::get();

        $downloads = Download::get();

        $sliders = Slider::get();
        $abouts = About::get();
        return view('web.site.pages.home.index', compact('majors', 'doctors', 'infos', 'sliders', 'abouts', 'downloads'));
    }
}
