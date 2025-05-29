<?php

namespace App\Enums;

enum Permissions: string
{
    case None = 'None';
    case OnLeave = 'OnLeave';
    case Hiatus = 'Hiatus';

    public function getDescription(): ?string
    {
        return match ($this) {
            self::None => 'Active Member',
            self::OnLeave => 'Left for a specified amount of time',
            self::Hiatus => 'Inactive until needs to be kicked',
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
