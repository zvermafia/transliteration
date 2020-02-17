<?php

namespace Zvermafia\Transliteration\Tests;

use ReflectionProperty;
use Zvermafia\Transliteration\Interfaces\TransliteratorInterface;

trait TransliteratorUnitCaseTrait
{
    /** @test */
    public function must_comply_liskov_substitution_principle()
    {
        $this->assertInstanceOf(TransliteratorInterface::class, $this->transliterator);
    }

    /** @test */
    public function a_user_can_set_text()
    {
        $text = 'Salom, dunyo!';

        $this->transliterator->setText($text);
        $this->assertEquals($text, $this->transliterator->getText());
    }

    /** @test */
    public function a_user_can_get_text()
    {
        $text = 'Salom, dunyo!';

        $this->transliterator->setText($text);
        $this->assertEquals($text, $this->transliterator->getText());
    }

    /** @test */
    public function a_user_can_change_transliteration_flag()
    {
        $this->transliterator->toLatin();
        $this->assertTrue($this->transliterator->isToLatin());

        $this->transliterator->toCyrillic();
        $this->assertTrue($this->transliterator->isToCyrillic());
    }

    /** @test */
    public function a_user_can_get_result_of_transliterated_text()
    {
        $reflection_property = new ReflectionProperty($this->transliterator, 'result');

        if ($reflection_property->isProtected()) {
            $reflection_property->setAccessible(true);
        }

        $result = 'Салом, дунё!';

        $reflection_property->setValue($this->transliterator, $result);
        $this->assertEquals($result, $this->transliterator->getResult());
    }

    /** @test */
    public function result_should_be_reset_when_a_user_will_set_a_new_text()
    {
        $reflection_property = new ReflectionProperty($this->transliterator, 'result');

        if ($reflection_property->isProtected()) {
            $reflection_property->setAccessible(true);
        }

        $result = 'Салом, дунё!';

        $reflection_property->setValue($this->transliterator, $result);
        $this->assertEquals($result, $this->transliterator->getResult());

        $this->transliterator->setText('Salom, dunyo!');
        $this->assertNull($this->transliterator->getResult());
    }
}
