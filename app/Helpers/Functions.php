<?php

namespace App\Helpers;

class Functions
{
    /**
     * use for unImplemented api routes
     *
     * @param  null
     * @return \Illuminate\Http\JsonResponse
     */
    static function unImplemented()
    {
        return response()->json([
            'message' => 'Is not Implemented',
            'status' => 'warning',
        ], 400);
    }
}
