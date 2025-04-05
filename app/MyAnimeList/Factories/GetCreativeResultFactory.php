<?php

declare(strict_types=1);

namespace App\MyAnimeList\Factories;

use App\MyAnimeList\DTOs\GetAnimeResultDTO;

class GetCreativeResultFactory
{
    public static function fromArray(): GetAnimeResultDTO
    {
        return new GetAnimeResultDTO();
    }
}
