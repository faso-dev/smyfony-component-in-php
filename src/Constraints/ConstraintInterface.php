<?php


namespace App\Constraints;

use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Interface ConstraintInterface
 * @package App\Constraints
 */
interface ConstraintInterface
{
    /**
     * @param array $constraints
     * @return ConstraintViolationList[]
     */
    public function with(array $constraints): array;

    /**
     * @param ConstraintViolationList[] $violations
     * @return string[]
     */
    public function buildViolationMessages(array $violations): array;
}