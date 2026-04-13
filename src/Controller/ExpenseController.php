<?php

namespace App\Controller;

use App\Repository\ExpenseRepository;
use App\Service\CurrencyConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExpenseController extends AbstractController
{
    #[Route('/expenses', name: 'app_expense_index')]
    public function index(ExpenseRepository $expenseRepository, CurrencyConverter $currencyConverter): Response
    {
        $expenses = $expenseRepository->findAll();
        $expenseRows = [];

        foreach ($expenses as $expense) {
            $wallet = $expense->getWallet();
            $convertedAmount = $currencyConverter->convert(
                $expense->getAmount(),
                $expense->getCurrency(),
                $wallet->getCurrency()
            );

            $expenseRows[] = [
                'expense' => $expense,
                'wallet' => $wallet,
                'convertedAmount' => $convertedAmount,
                'isOverBalance' => $convertedAmount > $wallet->getBalance(),
            ];
        }

        return $this->render('expense/index.html.twig', [
            'expenseRows' => $expenseRows,
        ]);
    }
}
