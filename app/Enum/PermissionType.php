<?php

namespace App\Enum;

enum PermissionType: string {
    case ACCESS_GENRES = 'edit-genres';
    case ACCESS_AUTHOURS = 'edit-authors';
    case ACCESS_BOOKS = 'edit-books';
    case ACCESS_USERS = 'edit-users';
}
