<?php

namespace App\Controller;

use App\Form\CalculatorForm;
use App\Service\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{


    #[Route('/calculator', name: 'calculator')]
    public function index(Request $request,CalculatorService $calculatorService): Response
    {
        $form = $this->createForm(CalculatorForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $result = $calculatorService->calculate($data['arg1'], $data['operation'], $data['arg2']);

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
}