<?php

namespace Dimtrovich\BlitzPHP\Vite\Config;

use Dimtrovich\BlitzPHP\Vite\Decorator;

class Registrar
{
    public static function view(): array
    {
        return [
            'decorators' => [
				Decorator::class
			],
        ];
    }
}
