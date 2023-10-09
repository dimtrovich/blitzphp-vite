<?php

namespace Dimtrovich\BlitzPHP\Vite;

use BlitzPHP\View\ViewDecoratorInterface;

class Decorator implements ViewDecoratorInterface
{
    public static function decorate(string $html): string
    {
        # Vérifiez si vite est en cours d’exécution ou si le manifeste est prêt.
        if (env('VITE_AUTO_INJECTING') && Vite::routeIsNotExluded() ) {
            if (Vite::isReady() === false) {
                throw new \Exception('Le package BlitzPHP Vite est installé, mais pas initialisé. avez-vous exécutez "php klinge vite:init" ?');
            }

			if (! str_contains($html, '<div id="app"')) {
				# Injecter d'abord le div de l'application
				$html = str_replace('<body>', "<body>\n\t<div id=\"app\">", $html);
				# Fermez le div
				$html = str_replace('</body>', "\n\t</div>\n</body>", $html);
			}

            # Obtenez les balises générées.
            $tags = Vite::tags();

            $jsTags  = $tags['js'];

            # maintenant injecter du CSS
            if (!empty($tags['css'])) {
                $cssTags = $tags['css'];

                $html = str_replace('</head>', "\n\t$cssTags\n", $html);
                $html = str_replace('</body>', "\n\t$jsTags\n</body>", $html);
            }
            else {
                $html = str_replace('</head>', "\n\t$jsTags\n</head>", $html);
            }
        }

        return $html;
    }
}
