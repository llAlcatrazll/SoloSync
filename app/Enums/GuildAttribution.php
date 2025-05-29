<?php

namespace App\Enums;

enum GuildAttribution: string
{
    case Gunhee = 'Guild Owner';
    case GunheeAlt = 'Guild Co-Owner';
    case Ðragons = 'Slackers';
    case GunheeMini = 'Non-Existant';
    case SoloXSlayer = 'solo slayer';
    case Superb = 'superbious';
    case RNG = 'rng guy';

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Gunhee => 'Ownver of the Guild',
            self::GunheeAlt => 'Co-Owner of the Guild with limited previlegas',
            self::Ðragons => 'Just a peasant',
            self::GunheeMini => 'Just a peasant',
            self::SoloXSlayer => 'Just a peasant',
            self::Superb => 'Just a peasant',
            self::RNG => 'Just a peasant',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Gunhee => 'heroicon-c-check-badge',
            self::GunheeAlt => 'phosphor-eyeglasses-fill',
            self::Ðragons => 'fas-dragon',
            self::GunheeMini => 'ri-sword-fill',
            self::SoloXSlayer => 'rpg-daggers',
            self::Superb => 'rpg-cat',
            self::RNG => 'fas-dice',
        };
    }

    public static function IconOptions(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [
                $case->value => $case->value.' - '.$case->getIcon(),
            ];
        })->toArray();
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
