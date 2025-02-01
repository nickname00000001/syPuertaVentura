<?php

namespace App\Enum;

enum PaymentMethod: string
{
    case p1 = 'Efectivo';
    case p2 = 'Tarjeta';
}