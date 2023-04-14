<?php

namespace App\Enum;

enum BookPublicationType: string {
    case PAPERBOOK = 'paper';
    case EBOOK = 'ebook';
    case GRAPHICAL = 'graphical';
}
