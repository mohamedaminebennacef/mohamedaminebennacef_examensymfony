<?php

namespace App\Service;

class CurrencyConverter
{
    private array $rates = [
        'EUR' => [
            'USD' => 1.1,
            'TND' => 3.2
        ],
        'USD' => [
            'EUR' => 1 / 1.1
        ],
        'TND' => [
            'EUR' => 1 / 3.2
        ]
    ];

    public function convert(float $amount, string $from, string $to): float
    {
        if ($from === $to) {
            return $amount;
        }

        if (!in_array($from, ['EUR', 'USD', 'TND']) || !in_array($to, ['EUR', 'USD', 'TND'])) {
            throw new \InvalidArgumentException("Devise non supportée");
        }

        if ($from !== 'EUR') {
            $amount *= $this->rates[$from]['EUR'];
        }

        if ($to !== 'EUR') {
            $amount *= $this->rates['EUR'][$to];
        }

        return $amount;
    }
}