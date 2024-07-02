<?php

/**
 * This file is part of Blitz PHP Vite.
 *
 * (c) 2024 Dimitri Sitchet Tomkeu <devcode.dst@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Dimtrovich\BlitzPHP\Vite\Config;

use Dimtrovich\BlitzPHP\Vite\Decorator;

class Registrar
{
    /**
     * @return array<string, string[]>
     */
    public static function view(): array
    {
        return [
            'decorators' => [
                Decorator::class,
            ],
        ];
    }
}
