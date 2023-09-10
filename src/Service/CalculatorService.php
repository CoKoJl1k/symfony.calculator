<?php

namespace App\Service;

class CalculatorService
{

    public function calculate(float $arg1, string $operation, float $arg2)
    {
        switch ($operation) {
            case '+':
                return $arg1 + $arg2;
            case '-':
                return $arg1 - $arg2;
            case '*':
                return $arg1 * $arg2;
            case '/':
                if ($arg2 != 0) {
                    return $arg1 / $arg2;
                } else {
                    throw new \InvalidArgumentException('Division by zero is not allowed.');
                }
            default:
                throw new \InvalidArgumentException('Invalid operation.');
        }
    }
}