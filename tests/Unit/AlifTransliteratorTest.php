<?php

namespace Zvermafia\Transliteration\Tests\Unit;

use Zvermafia\Transliteration\AlifTransliterator;
use Zvermafia\Transliteration\Tests\TransliteratorUnitCaseTrait;
use PHPUnit\Framework\TestCase;

class AlifTransliteratorTest extends TestCase
{
    use TransliteratorUnitCaseTrait;

    /** @var \Zvermafia\Transliteration\Interfaces\TransliteratorInterface */
    protected $transliterator;

    protected function setUp(): void
    {
        $this->transliterator = new AlifTransliterator();
    }
}
