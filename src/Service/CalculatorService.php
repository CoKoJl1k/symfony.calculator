<?php

namespace App\Service;


use Operation;


class CalculatorService
{

    /**
     * @throws \Exception
     */

    public function calculate(float $arg1, string $operation, float $arg2)
    {
        try {
            $result = match ($operation) {
                Operation::ADD => $arg1 + $arg2,
                Operation::SUBTRACT => $arg1 - $arg2,
                Operation::MULTIPLY => $arg1 * $arg2,
                Operation::DIVIDE => $arg2 != 0 ? $arg1 / $arg2 : throw new \InvalidArgumentException('Division by zero is not allowed.'),
                default => throw new \InvalidArgumentException('Invalid operation.'),
            };
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return $result;
    }

}