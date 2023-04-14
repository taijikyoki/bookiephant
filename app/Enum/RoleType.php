<?php

namespace App\Enum;

enum RoleType: string {
    case GUEST = 'guest';
    case USER = 'user';
    case ADMINISTRATOR = 'admin';
    case AUTHOR = 'author';
}
