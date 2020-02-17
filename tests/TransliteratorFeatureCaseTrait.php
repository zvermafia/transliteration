<?php

namespace Zvermafia\Transliteration\Tests;

use Zvermafia\Transliteration\Interfaces\TransliteratorInterface;

trait TransliteratorFeatureCaseTrait
{
    /** @test */
    public function must_comply_fluent_interface_design_pattern()
    {
        $this->assertInstanceOf(TransliteratorInterface::class, $this->transliterator->setText('Qanaqadir matn'));
        $this->assertInstanceOf(TransliteratorInterface::class, $this->transliterator->toCyrillic());
        $this->assertInstanceOf(TransliteratorInterface::class, $this->transliterator->translit());
    }

    /** @test */
    public function a_user_can_transliterate_a_text_in_different_directions()
    {
        $text = [
            'latin' => 'Salom, dunyo!',
            'cyrillic' => 'Салом, дунё!',
        ];

        $this->transliterator
            ->setText($text['latin'])
            ->toCyrillic()
            ->translit();

        $this->assertEquals($text['cyrillic'], $this->transliterator->getResult());

        $this->transliterator
            ->setText($text['cyrillic'])
            ->toLatin()
            ->translit();

        $this->assertEquals($text['latin'], $this->transliterator->getResult());
    }
}
