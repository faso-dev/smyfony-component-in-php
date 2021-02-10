<?php


namespace App\Constraints;


use Symfony\Component\Validator\Validation;

/**
 * Class Constraint
 * @package App\Constraints
 */
class Constraint implements ConstraintInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * Constraint constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function with(array $constraints): array
    {
        $validator = Validation::createValidator();

        $violations = [];

        foreach ($constraints as $field => $constraint) {
            $violations[$field] = $validator->validate($this->data[$field], $constraint);
        }

        return $this->buildViolationMessages($violations);
    }

    /**
     * @inheritDoc
     */
    public function buildViolationMessages(array $violations): array
    {
        $violationsMessages = [];

        foreach ($violations as $field => $violation) {
            foreach ($violation as $v) {
                $violationsMessages[$field] = $v->getMessage();
            }
        }

        return $violationsMessages;
    }
}