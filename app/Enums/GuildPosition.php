<?php

namespace App\Enums;

enum GuildPosition: string
{
    case Leader = 'Guild Owner';
    case ViceLeader = 'Guild Co-Owner';
    case Member = 'Just a regular dude';

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Leader => 'Ownver of the Guild',
            self::ViceLeader => 'Co-Owner of the Guild with limited previlegas',
            self::Member => 'Just a peasant',
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
