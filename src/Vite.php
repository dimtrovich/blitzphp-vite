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

class Vite
{
    /**
     * @var string manifest path.
     */
    public static $manifest = WEBROOT . '.vite' . DS . 'manifest.json';

    /**
     * Obtenez plutôt le fichier d’entrée vite sur les fichiers en cours d’exécution ou groupés.
     *
     * @return array<string, string> Balise de script unique sur le développement et bien plus encore sur la production
     */
    public static function tags(): ?array
    {
        $result = [
            'js'  => null,
            'css' => null,
        ];

        if (! on_prod(true)) {
            // Vérifiez si vite est en cours d'exécution.
            $entryFile = env('VITE_ORIGIN') . '/' . env('VITE_RESOURCES_DIR') . '/' . env('VITE_ENTRY_FILE');

            $result['js'] = @file_get_contents($entryFile) ? '<script data-vite type="module" src="' . $entryFile . '"></script>' : null;
        }

        // Correction React HRM.
        if (! empty($result['js'])) {
            $result['js'] = self::getReactTag() . $result['js'];
        }

        // Si vite ne fonctionne pas, renvoyez les ressources groupées.
        if (empty($result['js']) && is_file(self::$manifest)) {
            // Obtenez le contenu du manifeste.
            $manifest = file_get_contents(self::$manifest);
            // Vous êtes bien jolie en tant qu'objet php =).
            $manifest = json_decode($manifest);

            // Maintenant, nous allons obtenir tous les fichiers js et css du manifeste.
            foreach ($manifest as $file) {
                // Verifier l'extension
                $fileExtension = substr($file->file, -3, 3);

                // Generer la balise js.
                if ($fileExtension === '.js' && isset($file->isEntry) && $file->isEntry === true && (! isset($file->isDynamicEntry) || $file->isDynamicEntry !== true)) {
                    $result['js'] .= '<script data-vite type="module" src="/' . $file->file . '"></script>';
                }

                if (! empty($file->css)) {
                    foreach ($file->css as $cssFile) {
                        $result['css'] .= '<link data-vite rel="stylesheet" href="/' . $cssFile . '" />';
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Activation de HMR pour REACT.
     *
     * @see https://vitejs.dev/guide/backend-integration.html
     *
     * @return string|null un simple script de module
     */
    public static function getReactTag(): ?string
    {
        if (env('VITE_FRAMEWORK') === 'react') {
            $origin = env('VITE_ORIGIN');
            $result = "<script data-vite type=\"module\">import RefreshRuntime from '{$origin}/@react-refresh';RefreshRuntime.injectIntoGlobalHook(window);window.\$RefreshReg\$ = () => {};window.\$RefreshSig\$ = () => (type) => type;window.__vite_plugin_react_preamble_installed__ = true;</script>";

            return "{$result}\n\t";
        }

        return null;
    }

    /**
     * Vérifiez si vite est en cours d’exécution ou si le manifeste existe.
     *
     * @return bool true si vite est en cours d'exécution ou si le manifeste existe, sinon false ;
     */
    public static function isReady(): bool
    {
        $entryFile = env('VITE_ORIGIN') . '/' . env('VITE_RESOURCES_DIR') . '/' . env('VITE_ENTRY_FILE');

        if (on_prod(true)) {
            return is_file(self::$manifest);
        }

        switch (true) {
            case @file_get_contents($entryFile):
                $result = true;
                break;

            case is_file(self::$manifest):
                $result = true;
                break;

            default:
                $result = false;
        }

        return $result;
    }

    /**
     * Vérifiez si la route actuel est exclu ou non.
     */
    public static function routeIsNotExluded(): bool
    {
        $routes = explode(',', env('VITE_EXCLUDED_ROUTES', ''));

		foreach (array_map('trim', $routes) as $route) {
			if (url_is($route)) {
				return false;
			}
		}

		return true;
    }
}
