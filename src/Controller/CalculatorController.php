<?php

namespace App\Controller;

use App\Form\CalculatorForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{


    #[Route('/calculator', name: 'calculator')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CalculatorForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $result = $this->calculate($data['arg1'], $data['operation'], $data['arg2']);

            return $this->render('calculator/index.html.twig', [
                'expression' => sprintf('%s %s %s', $data['arg1'], $data['operation'], $data['arg2']),
                'result' => $result,
                'form' => $form->createView()
            ]);
        }

        return $this->render('calculator/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function calculate(float $arg1, string $operation, float $arg2): float
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