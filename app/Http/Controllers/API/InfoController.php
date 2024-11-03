<?php

namespace App\Http\Controllers\API;

use App\Models\Info;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InfoRequest;

class InfoController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infos = Info::get();
        return $this->responseSuccess('Data Retrieved Successfully', $infos->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InfoRequest $request)
    {
        $info = Info::create($request->validated());
        return $this->responseSuccess('Created Successfully', $info->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Info $info)
    {
        return $this->responseSuccess('Retreieved Successfully', $info->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InfoRequest $request, Info $info)
    {
        $info->update($request->validated());
        return $this->responseSuccess('updated Successfully', $info->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Info $info)
    {
        $info->delete();
        return $this->responseSuccess('Deleted Successfully', $info->toArray());
    }
}
