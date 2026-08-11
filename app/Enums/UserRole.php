<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Editor = 'editor';
    case Member = 'member';

    public function canAccessAdmin(): bool
    {
        return match ($this) {
            self::Admin, self::Editor => true,
            self::Member => false,
        };
    }

    public function canManageUsers(): bool
    {
        return $this === self::Admin;
    }
}
