<?php

namespace Zvermafia\Transliteration\Tests\Feature;

use Zvermafia\Transliteration\LotinTransliterator;
use Zvermafia\Transliteration\Tests\TransliteratorFeatureCaseTrait;
use PHPUnit\Framework\TestCase;

class LotinTransliteratorTest extends TestCase
{
    use TransliteratorFeatureCaseTrait;

    /** @var \Zvermafia\Transliteration\Interfaces\TransliteratorInterface */
    protected $transliterator;

    protected function setUp(): void
    {
        $mock = $this->getMockBuilder(LotinTransliterator::class)
            ->setMethods(['makeRequest'])
            ->getMock();

        $mock->method('makeRequest')
            ->will($this->onConsecutiveCalls(
                '{"message":"success","mod":"lattocyr","text":"Salom, dunyo!","result":"\u0421\u0430\u043b\u043e\u043c, \u0434\u0443\u043d\u0451!"}',
                '{"message":"success","mod":"cyrtolat","text":"\u0421\u0430\u043b\u043e\u043c, \u0434\u0443\u043d\u0451!","result":"Salom, dunyo!"}'
            ));

        $this->transliterator = $mock;
    }
}
