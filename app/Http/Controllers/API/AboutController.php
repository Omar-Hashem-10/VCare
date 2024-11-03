<?php

namespace App\Http\Controllers\API;

use App\Models\About;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutRequest;

class AboutController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::get();
        return $this->responseSuccess('Data Retrieved Successfully', $abouts->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        $about = About::create($request->validated());
        return $this->responseSuccess('Created Successfully', $about->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        return $this->responseSuccess('Retreieved Successfully', $about->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request, About $about)
    {
        $about->update($request->validated());
        return $this->responseSuccess('updated Successfully', $about->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about->delete();
        return $this->responseSuccess('Deleted Successfully', $about->toArray());
    }
}
