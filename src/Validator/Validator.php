<?php


namespace App\Validator;


use App\Constraints\Constraint;
use App\Constraints\ConstraintInterface;

/**
 * Class Validator
 * @package App\Validator
 */
class Validator implements ValidatorInterface
{

    public static function validate(array $data): ConstraintInterface
    {
        return new Constraint($data);
    }
}