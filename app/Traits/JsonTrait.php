<?php

namespace App\Traits;

/*--------------------------------
| Create Dynamic Messqge Of API Response
----------------------------------*/

trait JsonTrait
{
    /**
     * The request succeeded 200 ok
     * 
     * @return \Illuminate\Http\Response
     */
    public function SuccessMessage($arr = '')
    {
        $data = ['status' => 200, 'error' => false, 'message' => 'success', 'data' => $arr];

        return response()->json($data);
    }

    /**
     * The request succeeded 201
     * 
     * @return \Illuminate\Http\Response
     */
    public function RequestSucessfulMessage($arr = '')
    {
        $data = ['status' => 201, 'error' => false, 'message' => 'The request succeeded', 'data' => $arr];

        return response()->json($data);
    }

    /**
     * BadRequestException 400
     * 
     * @return \Illuminate\Http\Response
     */
    public function ErrorMessage($e)
    {
        $data = ['status' => 400, 'error' => true, 'message' => $e,];

        return response()->json($data);
    }

    /**
     * Internal Server Error 500
     * 
     * @return \Illuminate\Http\Response
     */
    public function Error505Message($e)
    {
        $data = ['status' => 500, 'error' => true, 'message' => $e,];

        return response()->json($data);
    }

    /**
     * 404 Not Found
     * 
     * @return \Illuminate\Http\Response
     */
    public function Error404Message($e)
    {
        $data = ['status' => 404, 'error' => true, 'message' => $e,];

        return response()->json($data);
    }

    /**
     * Create Validation Message 
     * 
     * @return \Illuminate\Http\Response
     */
    public function ValidationMessage($message)
    {
        $data = [
            'status' => 400,
            'error' => true,
            'message' => $message
        ];
        return response()->json($data);
    }
}
