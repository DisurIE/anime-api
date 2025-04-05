<?php

namespace App\MyAnimeList\Remote;

use Exception;
use JsonException;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Client as GuzzleHttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpClient
{
    public const TIMEOUT = 2;

    protected ClientInterface $httpClient;

    public function __construct(
        string $baseUrl,
        string $token,
        $timeout = HttpClient::TIMEOUT
    ) {
        $headers = [
            'Accept'        => 'application/json',
            'Authorization' => "Bearer $token",
            ];

        $this->httpClient = new GuzzleHttpClient([
            'base_uri' => $baseUrl,
            'headers' => $headers,
            'timeout' => $timeout,
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function requestGet(string $uri, array $data = []): mixed
    {
        return $this->request(Request::METHOD_GET, $uri, $data);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    private function request(string $method, string $uri, array $data = [], ?string $RequestOption = null)
    {
        $option = $RequestOption ?? match ($method) {
            Request::METHOD_GET => RequestOptions::QUERY,
            Request::METHOD_POST, Request::METHOD_PUT => RequestOptions::JSON,
            default => throw new Exception()
        };

        try {
            $response = $this->httpClient->request($method, $uri, [
                $option => $data,
            ]);
        } catch (ConnectException $exception) {
            throw new Exception($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            $code = $response?->getStatusCode();

            if (in_array($code, [Response::HTTP_BAD_REQUEST, Response::HTTP_UNAUTHORIZED, Response::HTTP_FORBIDDEN, Response::HTTP_NOT_FOUND], true)) {
                try {
                    $contents = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

                    $message = $contents['error'] ?? $response->getReasonPhrase();
                    $responseData = $contents ?? [];
                } catch (JsonException $exception) {
                    $message = $response->getReasonPhrase();
                }
            }

            throw match ($code) {
                default => new Exception($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR),
            };
        }

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}
