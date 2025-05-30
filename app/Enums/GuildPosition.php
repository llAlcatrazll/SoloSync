<?php

namespace App\Enums;

enum GuildPosition: string
{
    case Leader = 'Leader';
    case ViceLeader = 'ViceLeader';
    case Member = 'Member';

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Leader => 'Ownver of the Guild',
            self::ViceLeader => 'Co-Owner of the Guild with limited previlegas',
            self::Member => 'Just a peasant',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Leader => 'danger',
            self::ViceLeader => 'info',
            self::Member => 'success',
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
