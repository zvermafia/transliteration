<?php

namespace Zvermafia\Transliteration\Interfaces;

/**
 * Transliterator interface
 *
 * This interface class defines the standart function that any transliterator needs to define.
 */
interface TransliteratorInterface
{
    /**
     * Set the text which needs to transliteration.
     *
     * @param string $text
     * @return TransliteratorInterface
     */
    public function setText(string $text): TransliteratorInterface;

    /**
     * Get the original text.
     *
     * @return string|null
     */
    public function getText(): ?string;

    /**
     * Set the transliteration direction to latin.
     *
     * @return TransliteratorInterface
     */
    public function toLatin(): TransliteratorInterface;

    /**
     * Check transliteration direction is "to latin".
     *
     * @return bool
     */
    public function isToLatin(): bool;

    /**
     * Set the transliteration direction to cyrillic.
     *
     * @return TransliteratorInterface
     */
    public function toCyrillic(): TransliteratorInterface;

    /**
     * Check transliteration direction is "to cyrillic".
     *
     * @return bool
     */
    public function isToCyrillic(): bool;

    /**
     * Translit the text.
     *
     * @return TransliteratorInterface
     */
    public function translit(): TransliteratorInterface;

    /**
     * Get the result of the transliterated text.
     *
     * @return string|null
     */
    public function getResult(): ?string;
}
