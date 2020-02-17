<?php

namespace Zvermafia\Transliteration\Abstracts;

use Zvermafia\Transliteration\Interfaces\TransliteratorInterface;

/**
 * Base transliterator class
 *
 * This base class should be extended by all transliterators.
 * It enforces implementaion of the TransliteratorInterface interface and
 * defines various common attributes and methos that all transliterators should have.
 */
abstract class TransliteratorAbstract implements TransliteratorInterface
{
    /** @var string|null */
    protected $text = null;

    /** @var bool Determine transliteration direction is to cyrillic or not */
    protected $is_to_cyrillic = true;

    /** @var string|null */
    protected $result = null;

    /**
     * @inheritDoc
     */
    public function setText(string $text): TransliteratorInterface
    {
        $this->text = $text;
        $this->clearResult();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @inheritDoc
     */
    public function toLatin(): TransliteratorInterface
    {
        $this->is_to_cyrillic = false;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isToLatin(): bool
    {
        return ! $this->is_to_cyrillic;
    }

    /**
     * @inheritDoc
     */
    public function toCyrillic(): TransliteratorInterface
    {
        $this->is_to_cyrillic = true;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isToCyrillic(): bool
    {
        return $this->is_to_cyrillic;
    }

    /**
     * Set the transliterated text result.
     *
     * @param string $text
     * @return void
     */
    protected function setResult(string $text): void
    {
        $this->result = $text;
    }

    /**
     * @inheritDoc
     */
    public function getResult(): ?string
    {
        return $this->result;
    }

    /**
     * Clear result text.
     *
     * When set a new text there is not yet a result text for the new text,
     * so we have to clear the result text to avoid a wrong result.
     *
     * @return void
     */
    protected function clearResult(): void
    {
        $this->result = null;
    }
}
