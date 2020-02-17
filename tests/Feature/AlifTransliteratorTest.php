<?php

namespace Zvermafia\Transliteration\Tests\Feature;

use Zvermafia\Transliteration\AlifTransliterator;
use Zvermafia\Transliteration\Tests\TransliteratorFeatureCaseTrait;
use PHPUnit\Framework\TestCase;

class AlifTransliteratorTest extends TestCase
{
    use TransliteratorFeatureCaseTrait;

    /** @var \Zvermafia\Transliteration\Interfaces\TransliteratorInterface */
    protected $transliterator;

    protected function setUp(): void
    {
        $mock = $this->getMockBuilder(AlifTransliterator::class)
            ->setMethods(['makeRequest'])
            ->getMock();

        $mock->method('makeRequest')
            ->will($this->onConsecutiveCalls(
                '{"InputText":"Salom, dunyo!","OutputText":"\u0421\u0430\u043b\u043e\u043c, \u0434\u0443\u043d\u0451!","IsLatToCyr":true}',
                '{"InputText":"\u0421\u0430\u043b\u043e\u043c, \u0434\u0443\u043d\u0451!","OutputText":"Salom, dunyo!","IsLatToCyr":false}'
            ));

        $this->transliterator = $mock;
    }
}
