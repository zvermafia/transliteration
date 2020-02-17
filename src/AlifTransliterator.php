<?php

namespace Zvermafia\Transliteration;

use Zvermafia\Transliteration\Abstracts\HttpTransliteratorAbstract;

/**
 * Class AlifTransliterator
 * @link http://alif.uz/ The website of the transliteration service (API)
 */
class AlifTransliterator extends HttpTransliteratorAbstract
{
    /** @var string */
    protected const API_URI = 'http://www.alif.uz/api/translit/';

    /**
     * @inheritDoc
     */
    protected function getDefaultOptions(): array
    {
        return [
            \CURLOPT_URL => self::API_URI,
            \CURLOPT_POST => true,
            \CURLOPT_HTTPHEADER => [
                'Accept: application/json; charset=utf-8',
                'Content-Type: application/json; charset=utf-8',
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getPerRequestOptions(): array
    {
        return [
            \CURLOPT_POSTFIELDS => json_encode([
                'inputText' => $this->getText(),
                'isLatToCyr' => $this->isToCyrillic() ? 'true' : 'false',
            ]),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getResultFromResponse(string $response): string
    {
        return json_decode($response)->OutputText;
    }
}
