<?php

namespace App\Models;

class PackageValidation
{
    public const ERROR_MESSAGES = [
        'required'    => 'The field: attribute is required',
        'numeric'     => 'Field value must be numeric',
        'date_format' => 'The date format should be in the American standard: Y-m-d',
        'max'         => 'The: attribute must have at least: max characters'
    ];

    public const RULE_NEW_PACKAGE = [
        'name'       => 'required | max:80',
        'value'	     => 'required | numeric',
        'beginDate' => 'required | date_format:"Y-m-d"',
        'endDate'    => 'required | date_format:"Y-m-d"',
        'description'  => 'required'
    ];

}