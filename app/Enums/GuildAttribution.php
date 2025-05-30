<?php

namespace App\Enums;

enum GuildAttribution: string
{
    case Gunhee = 'Gunhee';
    case GunheeAlt = 'GunheeAlt';
    case Ðragons = 'Ðragons';
    case GunheeMini = 'GunheeMini';
    case SoloXSlayer = 'SoloXSlayer';
    case Superb = 'Superb';
    case RNG = 'RNG';

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Gunhee => 'Owner of the Guild',
            self::GunheeAlt => 'Co-Owner of the Guild with limited privileges',
            self::Ðragons,
            self::GunheeMini,
            self::SoloXSlayer,
            self::Superb,
            self::RNG => 'Just a peasant',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Gunhee => 'mdi-mustache',
            self::GunheeAlt => 'phosphor-eyeglasses-fill',
            self::Ðragons => 'fas-dragon',
            self::GunheeMini => 'ri-sword-fill',
            self::SoloXSlayer => 'rpg-daggers',
            self::Superb => 'rpg-cat',
            self::RNG => 'fas-dice',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Gunhee => 'Gunhee',
            self::GunheeAlt => 'GunheeAlt',
            self::Ðragons => 'Dragons',
            self::GunheeMini => 'GunheeMini',
            self::SoloXSlayer => 'SoloXSlayer',
            self::Superb => 'Superb',
            self::RNG => 'RNG',
        };
    }

    public static function IconOptions(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($case) => [
            $case->value => $case->value.' - '.$case->getIcon(),
        ])->toArray();
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($case) => [
            $case->value => $case->value.' - '.$case->getDescription(),
        ])->toArray();
    }
}
