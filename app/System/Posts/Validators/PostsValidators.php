<?php


namespace App\System\Posts\Validators;


use Illuminate\Http\Request;
use \Validator;
class PostsValidators
{
    private $errors;

    public function createValidation(Request $request)
    {
        // ToDo:: Posts Creation Validation Rules
        $rules = [];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            $this->errors = $validator->errors()->all();
            return false;
        }

        return true;
    }

    public function updateValidation(Request $request)
    {
        // ToDo:: Post Creation Validation Rules
        $rules = [];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            $this->errors = $validator->errors()->all();
            return false;
        }

        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}
