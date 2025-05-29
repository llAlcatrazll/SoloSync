<?php

namespace App\Enums;

enum Status: string
{
    case Active = 'Active';
    case Kicked = 'Kicked';
    case Widthrawn = 'Widthrawn';

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Active => 'Active Member',
            self::Kicked => 'Lacked the minimum requirements',
            self::Widthrawn => 'Left the guild on their own violition',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [
                $case->value => $case->value.' - '.$case->getDescription(),
            ];
        })->toArray();
    }
}
