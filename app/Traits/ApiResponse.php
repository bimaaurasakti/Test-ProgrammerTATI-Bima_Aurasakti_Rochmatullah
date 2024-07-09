<?php

namespace App\Traits;

trait ApiResponse{

    protected function successResponse($data = [], $message = null)
	{
        if (empty($message)) {
            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        } else if (empty($data)) {
            return response()->json([
                'success' => true,
                'message' => $message
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], 200);
        }
	}

    protected function successResponsePaginate($data = [], $message = null)
	{
        if (empty($message)) {
            return response()->json([
                'success' => true,
                'paginate' => $data,
            ], 200);
        } else if (empty($data)) {
            return response()->json([
                'success' => true,
                'message' => $message
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => $message,
                'paginate' => $data,
            ], 200);
        }
	}

	protected function errorResponse($message, $code = 500)
	{
		return response()->json([
			'success'=> false,
			'message' => $message,
		], $code);
	}

    protected function select2SuccessResponse($count_filtered, $data = [], $pagination = [])
	{
        if (empty($pagination)) {
            return response()->json([
                'results' => $data,
                'count_filtered' => $count_filtered
            ], 200);
        } else {
            return response()->json([
                'results' => $data,
                'count_filtered' => $count_filtered,
                'pagination' => $pagination
            ], 200);
        }
	}
}
