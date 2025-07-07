<?php

if (!function_exists('statusLabel')) {
    function statusLabel(?string $status = null): array|string
    {
        $map = [
            'available' => 'Dostępny',
            'pending' => 'Oczekujący',
            'sold' => 'Sprzedany',
        ];

        if ($status !== null) {
            return $map[$status] ?? ucfirst($status);
        }

        return $map;
    }
}
