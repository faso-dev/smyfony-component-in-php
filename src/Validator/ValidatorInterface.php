<?php


namespace App\Validator;

use App\Constraints\ConstraintInterface;

/**
 * Interface ValidatorInterface
 * @package App\Validator
 */
interface ValidatorInterface
{
    /**
     * @param array $data
     * @return ConstraintInterface
     */
    public static function validate(array $data): ConstraintInterface;
}