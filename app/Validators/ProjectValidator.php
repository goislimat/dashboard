<?php

namespace Dashboard\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator {

    protected $rules = [
        'owner_id' => 'required',
        'client_id' => 'required',
        'name' => 'required|max:100',
        'description' => 'required',
        'progress' => 'required|min:0|max:100',
        'status' => 'required',
        'due_date' => 'required'
   ];

}