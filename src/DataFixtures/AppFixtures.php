<?php

namespace App\DataFixtures;

use App\Entity\Expense;
use App\Entity\Wallet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $walletsData = [
            ['name' => 'Portefeuille Principal', 'currency' => 'EUR', 'balance' => 1250.00],
            ['name' => 'Travel Wallet', 'currency' => 'TND', 'balance' => 450.00],
            ['name' => 'Compte Tunis', 'currency' => 'TND', 'balance' => 1800.00],
            ['name' => 'Savings EUR', 'currency' => 'EUR', 'balance' => 3200.00],
            ['name' => 'Emergency USD', 'currency' => 'USD', 'balance' => 200.00],
        ];

        $wallets = [];

        foreach ($walletsData as $walletData) {
            $wallet = (new Wallet())
                ->setName($walletData['name'])
                ->setCurrency($walletData['currency'])
                ->setBalance($walletData['balance']);

            $manager->persist($wallet);
            $wallets[] = $wallet;
        }

        $expensesData = [
            ['description' => 'Courses hebdomadaires', 'amount' => 85.50, 'currency' => 'EUR', 'date' => '2026-04-01 10:00:00', 'walletIndex' => 0],
            ['description' => 'Abonnement streaming', 'amount' => 14.99, 'currency' => 'USD', 'date' => '2026-04-02 18:15:00', 'walletIndex' => 1],
            ['description' => 'Taxi aeroport', 'amount' => 42.00, 'currency' => 'USD', 'date' => '2026-04-03 07:45:00', 'walletIndex' => 4],
            ['description' => 'Restaurant', 'amount' => 12000.00, 'currency' => 'TND', 'date' => '2026-04-04 21:00:00', 'walletIndex' => 2],
            ['description' => 'Achat livres', 'amount' => 6500.00, 'currency' => 'EUR', 'date' => '2026-04-05 14:30:00', 'walletIndex' => 3],
            ['description' => 'Essence', 'amount' => 5500.00, 'currency' => 'EUR', 'date' => '2026-04-06 09:20:00', 'walletIndex' => 0],
            ['description' => 'Hotel weekend', 'amount' => 380.00, 'currency' => 'USD', 'date' => '2026-04-07 19:10:00', 'walletIndex' => 1],
            ['description' => 'Shopping centre', 'amount' => 900.00, 'currency' => 'TND', 'date' => '2026-04-08 16:40:00', 'walletIndex' => 2],
            ['description' => 'Facture internet', 'amount' => 35.00, 'currency' => 'EUR', 'date' => '2026-04-09 08:00:00', 'walletIndex' => 3],
            ['description' => 'Billet de train', 'amount' => 75.00, 'currency' => 'EUR', 'date' => '2026-04-10 12:25:00', 'walletIndex' => 4],
        ];

        foreach ($expensesData as $expenseData) {
            $expense = (new Expense())
                ->setDescription($expenseData['description'])
                ->setAmount($expenseData['amount'])
                ->setCurrency($expenseData['currency'])
                ->setDate(new \DateTime($expenseData['date']))
                ->setWallet($wallets[$expenseData['walletIndex']]);

            $manager->persist($expense);
        }

        $manager->flush();
    }
}
