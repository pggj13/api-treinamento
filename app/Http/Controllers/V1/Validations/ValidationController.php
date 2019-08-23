<?php

namespace App\Http\Controllers\V1\Validations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

/**
 * @resource Validation
 */
class ValidationController extends Controller {
    

    public function exists(Request $request) {

        var_dump($request->get());exit;
        $validator = Validator::make(
            [
                'value' => $request->get('value')
            ], 
            [
                'value' => 'exists:' . $request->get('table') . "," . $request->get("column")
            ]
        );

        return response()->json(['isValid' => !$validator->fails()]);
    }

    public function unique(Request $request) {

        $data = [
            'value' => $request->get('value')
        ];

        $rule = [
            'value' => 'unique:' . $request->get('table') . "," . $request->get("column") . "," . $request->get("ignore")
        ];

        $validator = Validator::make($data, $rule); 

        return response()->json(['isValid' => !$validator->fails()]);
    }

}
