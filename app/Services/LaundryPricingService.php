<?php

namespace App\Services;

class LaundryPricingService
{
    public function calculate(array $data): array
    {
        $weight = (float) $data['laundry_weight'];

        $basePrice = [
            'setrika' => 10000,
            'cuci_kering' => 11500,
            'cuci_setrika' => 13000,
        ];

        $pricePerKg = $basePrice[$data['laundry_type']] ?? 10000;

        // Express surcharge 30%
        if ($data['category'] === 'express') {
            $pricePerKg *= 1.3;
        }

        $pricePerKg = round($pricePerKg);

        $laundrySubtotal = round($pricePerKg * $weight);

        $perfumePrice = [
            'dior' => 5000,
            'ysl' => 3000,
            'molto' => 2000,
        ];

        $perfumeFee = $perfumePrice[$data['perfume'] ?? ''] ?? 0;

        $serviceFee = 1500;

        return [
            'price_per_kg' => $pricePerKg,
            'laundry_subtotal' => $laundrySubtotal,
            'perfume_fee' => $perfumeFee,
            'service_fee' => $serviceFee,
            'total_price' => $laundrySubtotal + $perfumeFee + $serviceFee,
        ];
    }
}
