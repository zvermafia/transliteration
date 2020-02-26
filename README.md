# Uzbek transliterator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Uzbek latin <=> cyrillic transliterator.
Under the hood it uses some online transliteration services. But it's extendable!

### Navigation by sections

- <a href="#install">Install</a>
- <a href="#usage">Usage</a>
- <a href="#make-your-own-implementation-extending">Make your own implementation (extending)</a>
- <a href="#change-log">Change log</a>
- <a href="#testing">Testing</a>
- <a href="#contributing">Contributing</a>
- <a href="#security">Security</a>
- <a href="#credits">Credits</a>
- <a href="#license">License</a>

## Install

Via Composer

``` bash
$ composer require zvermafia/uzbek-transliterator
```

## Usage

Out of the box there are two implementations for your choice:
1. `Zvermafia\Transliteration\AlifTransliterator` which uses an [alif.uz](http://alif.uz) online transliteration service's API;
2. `Zvermafia\Transliteration\LotinTransliterator` which uses a [lotin.uz](https://lotin.uz) online transliteration service's API;

Also you can implement your own class which will use another service's API or won't use any services' API and does all the job by itself.

``` php
require __DIR__ . "/vendor/autoload.php";

// Initialize the object
$transliterator = new Zvermafia\Transliteration\AlifTransliterator(); // or you can use LotinTransliterator

$transliterator->setText("Salom, dunyo!")
    ->toCyrillic()
    ->translit();

echo $transliterator->getResult(); // it will output: Салом, дунё!
```

## Make your own implementation (extending)

If these two already exist implementations aren't enough for you, then you can extend functionalities of this package by implementing your own transliterator class. If so there are three possible ways:
1. Create a class by implementing a `Zvermafia\Transliteration\Interfaces\TransliteratorInterface` interface. In this case you must realize all the methods defined in the interface from scratch by yourself;
2. This is the recommended way (if you're not going to use third party APIs with HTTP). Create a class by extending `Zvermafia\Transliteration\Abstracts\TransliteratorAbstract` abstract class. In this case you must realize only that methods which aren't already realized by the abstract class. The abstract class already realized common methods of the interface;
3. This one is similar to the previous way. Because in this case you'll use a `Zvermafia\Transliteration\Abstracts\HttpTransliteratorAbstract` abstract class which is extends by the `Zvermafia\Transliteration\Abstracts\TransliteratorAbstract`. But what is the difference? The difference is in this abstract class realized some common methods which will work with the HTTP through the cURL extension. So you must only configure some specific HTTP request parameters to work with an API.

So here are examples by the points.

**An example for the point number 1:**

```php
<?php

namespace Whatever\Namespace;

use Zvermafia\Transliteration\Interfaces\TransliteratorInterface;

// point #1
class MyTransliterator implements TransliteratorInterface
{
    // realize all the methods defined in the interface (
}
```

**An example for the point number 2:**

```php
<?php

namespace Whatever\Namespace;

use Zvermafia\Transliteration\Abstracts\TransliteratorAbstract;
use Zvermafia\Transliteration\Interfaces\TransliteratorInterface;

// point #1
class MyTransliterator extends TransliteratorAbstract
{
    public function translit(): : TransliteratorInterface
    {
        $text = $this->getText();
        // $result = ... // here translit the text
        $this->setResult($result);

        return $this;
    }
}
```

**An example for the point number 3:**  

As examples for this point you can see source codes of `Zvermafia\Transliteration\AlifTransliterator` and `Zvermafia\Transliteration\LotinTransliterator`.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email mohirjon@gmail.com instead of using the issue tracker.

## Credits

- [Mokhirjon Naimov][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/zvermafia/transliteration.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/zvermafia/transliteration/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/zvermafia/transliteration.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/zvermafia/transliteration.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/zvermafia/transliteration.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/zvermafia/transliteration
[link-travis]: https://travis-ci.org/zvermafia/transliteration
[link-scrutinizer]: https://scrutinizer-ci.com/g/zvermafia/transliteration/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/zvermafia/transliteration
[link-downloads]: https://packagist.org/packages/zvermafia/transliteration
[link-author]: https://github.com/zvermafia
[link-contributors]: ../../contributors
