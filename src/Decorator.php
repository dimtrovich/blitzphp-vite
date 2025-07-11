<?php

/**
 * This file is part of Blitz PHP Vite.
 *
 * (c) 2024 Dimitri Sitchet Tomkeu <devcode.dst@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Dimtrovich\BlitzPHP\Vite;

use BlitzPHP\Contracts\View\ViewDecoratorInterface;
use Exception;

class Decorator implements ViewDecoratorInterface
{
    public static function decorate(string $html): string
    {
        // Vérifiez si vite est en cours d’exécution ou si le manifeste est prêt.
        if (env('VITE_AUTO_INJECTING') && Vite::routeIsNotExluded() && ! is_cli()) {
            if (Vite::isReady() === false) {
                throw new Exception('Le package BlitzPHP Vite est installé, mais pas initialisé. avez-vous exécutez "php klinge vite:init" ?');
            }

            if (! str_contains($html, '<div id="app"')) {
                // Injecter d'abord le div de l'application
                $html = str_replace('<body>', "<body>\n\t<div id=\"app\">", $html);
                // Fermez le div
                $html = str_replace('</body>', "\n\t</div>\n</body>", $html);
            }

            // Obtenez les balises générées.
            $tags = Vite::tags();

            $jsTags = $tags['js'];

            // maintenant injecter du CSS
            if (! empty($tags['css'])) {
                $cssTags = $tags['css'];

                if (! str_contains($html, '<link data-vite')) {
                    $html = str_replace('</head>', "\n\t{$cssTags}\n", $html);
                }
                if (! str_contains($html, '<script data-vite')) {
                    $html = str_replace('</body>', "\n\t{$jsTags}\n</body>", $html);
                }
            } elseif (! str_contains($html, '<script data-vite')) {
                $html = str_replace('</head>', "\n\t{$jsTags}\n</head>", $html);
            }
        }

        return $html;
    }
}
