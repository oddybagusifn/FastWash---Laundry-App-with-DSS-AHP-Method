<?php

namespace App\Services;

class AhpService
{
    /**
     * Hitung AHP lengkap (weights + CR)
     */
    public function calculate(array $matrix): array
    {
        $n = count($matrix);

        // 1. Jumlah kolom
        $colSum = array_fill(0, $n, 0);
        foreach ($matrix as $row) {
            foreach ($row as $j => $value) {
                $colSum[$j] += $value;
            }
        }

        // 2. Normalisasi matriks
        $normalized = [];
        foreach ($matrix as $i => $row) {
            foreach ($row as $j => $value) {
                $normalized[$i][$j] = $value / $colSum[$j];
            }
        }

        // 3. Eigen vector (bobot)
        $weights = [];
        foreach ($normalized as $row) {
            $weights[] = array_sum($row) / $n;
        }

        // 4. λ max
        $lambdaMax = 0;
        for ($i = 0; $i < $n; $i++) {
            $rowSum = 0;
            for ($j = 0; $j < $n; $j++) {
                $rowSum += $matrix[$i][$j] * $weights[$j];
            }
            $lambdaMax += $rowSum / $weights[$i];
        }
        $lambdaMax /= $n;

        // 5. CI & CR
        $ci = ($lambdaMax - $n) / ($n - 1);
        $riTable = [1 => 0.00, 2 => 0.00, 3 => 0.58, 4 => 0.90, 5 => 1.12];
        $cr = $ci / ($riTable[$n] ?? 1);

        return [
            'weights' => $weights,
            'cr' => $cr,
            'is_consistent' => $cr <= 0.1,
        ];
    }

    /**
     * Shortcut jika hanya butuh bobot
     */
    public function calculateCriteriaWeights(array $matrix): array
    {
        return $this->calculate($matrix)['weights'];
    }
}
