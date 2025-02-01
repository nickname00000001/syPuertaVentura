<?php

namespace App\Enum;

enum PaymentStatus: string
{
    case s1 = 'Pagado';
    case s2 = 'Pendiente';
}