<?php

declare(strict_types=1);

namespace App\MyAnimeList\Clients\Anime;

use JsonException;
use App\MyAnimeList\Remote\HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use App\MyAnimeList\DTOs\GetAnimeResultDTO;
use App\MyAnimeList\Contracts\MyAnimeListClient;
use App\MyAnimeList\Factories\GetCreativeResultFactory;

class RemoteAnimeClient implements MyAnimeListClient
{

    private const string GET_ANIME = '/anime';
    protected HttpClient $httpClient;

    public function __construct(
        string $token = '',
        float $timeout = HttpClient::TIMEOUT,
    ) {
        $this->httpClient = new HttpClient(env('MY_ANIME_LIST_URL'), env('MY_ANIME_LIST_TOKEN'), $timeout);
    }


    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function getAnime(): GetAnimeResultDTO
    {
        $uri = self::GET_ANIME;
        $result = $this->httpClient->requestGet($uri);

        return GetCreativeResultFactory::fromArray($result);

    }
}
