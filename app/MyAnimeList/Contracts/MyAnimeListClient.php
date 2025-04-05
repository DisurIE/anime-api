<?php

declare(strict_types=1);

namespace App\MyAnimeList\Contracts;

use App\MyAnimeList\DTOs\GetAnimeResultDTO;

interface MyAnimeListClient
{
    public function getAnime(): GetAnimeResultDTO;
}
