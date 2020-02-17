<?php

namespace Zvermafia\Transliteration;

use Zvermafia\Transliteration\Abstracts\HttpTransliteratorAbstract;

/**
 * Class LotinTransliterator
 * @link https://lotin.uz/ The website of the transliteration service (API)
 */
class LotinTransliterator extends HttpTransliteratorAbstract
{
    /** @var string */
    protected const API_URI = 'https://lotin.uz/api/translate';

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
                'text' => $this->getText(),
                'mod' => $this->isToCyrillic() ? 'lattocyr' : 'cyrtolat',
            ]),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getResultFromResponse(string $response): string
    {
        return json_decode($response)->result;
    }
}
