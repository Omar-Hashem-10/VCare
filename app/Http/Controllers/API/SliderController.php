<?php

namespace App\Http\Controllers\API;

use App\Models\Slider;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;

class SliderController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::get();
        return $this->responseSuccess('Data Retrieved Successfully', $sliders->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $slider = Slider::create($request->validated());
        return $this->responseSuccess('Created Successfully', $slider->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return $this->responseSuccess('Retreieved Successfully', $slider->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $slider->update($request->validated());
        return $this->responseSuccess('updated Successfully', $slider->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return $this->responseSuccess('Deleted Successfully', $slider->toArray());
    }
}
