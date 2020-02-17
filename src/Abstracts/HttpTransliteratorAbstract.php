<?php

namespace Zvermafia\Transliteration\Abstracts;

use Zvermafia\Transliteration\Interfaces\TransliteratorInterface;
use Zvermafia\Transliteration\Exceptions\TransliteratorException;

/**
 * Base transliterator class
 *
 * This base class can be extended by all transliterators which will use cURL as an HTTP handler.
 */
abstract class HttpTransliteratorAbstract extends TransliteratorAbstract
{
    /** @var resource */
    protected $curl_handle;

    /**
     * Initialize a cURL instance.
     */
    public function __construct()
    {
        $this->curl_handle = \curl_init();
        \curl_setopt_array(
            $this->curl_handle,
            array_replace(
                $this->getDefaultOptions(),
                [
                    \CURLOPT_RETURNTRANSFER => true,
                    \CURLOPT_USERAGENT => 'Zvermafia-Transliteration/2.0.0 (+https://zvermafia/transliteration)',
                ]
            )
        );
    }

    /**
     * Destroy the cURL instance.
     */
    public function __destruct()
    {
        \curl_close($this->curl_handle);
    }

    /**
     * @inheritDoc
     */
    public function translit(): TransliteratorInterface
    {
        $this->setResult($this->getResultFromResponse($this->makeRequest()));

        return $this;
    }

    /**
     * Make request to an API.
     *
     * @throws \Zvermafia\Transliteration\Exceptions\TransliteratorException
     * @return string Response body
     */
    protected function makeRequest(): string
    {
        \curl_setopt_array($this->curl_handle, $this->getPerRequestOptions());
        $response = \curl_exec($this->curl_handle);

        if ($response === false || \curl_errno($this->curl_handle) !== 0) {
            throw new TransliteratorException(
                \curl_error($this->curl_handle),
                \curl_getinfo($this->curl_handle, CURLINFO_HTTP_CODE)
            );
        }

        return $response;
    }

    /**
     * Get default options for all the subsequent requests.
     *
     * @return array
     */
    abstract protected function getDefaultOptions(): array;

    /**
     * Get per request options.
     *
     * @return array
     */
    abstract protected function getPerRequestOptions(): array;

    /**
     * Fetch the result from the response and return it.
     *
     * @param string $response
     * @return string
     */
    abstract protected function getResultFromResponse(string $response): string;
}
