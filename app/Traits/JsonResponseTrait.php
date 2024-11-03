<?php

namespace App\Traits;

trait JsonResponseTrait {
    /**
     *  Make unified Http response success
     * @param string $message
     * @param array $data
     * @return Illuminate\Http\JsonResponse|mixed
     */
    public function responseSuccess(string $message, array $data = null) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ]);
    }

    /**
     * Make unified Http response failure
     * @param string $message
     * @param int $status
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function responseFailure(string $message = '', int $status) {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
