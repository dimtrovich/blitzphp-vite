<?php

/**
 * This file is part of Blitz PHP Vite.
 *
 * (c) 2024 Dimitri Sitchet Tomkeu <devcode.dst@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Dimtrovich\BlitzPHP\Vite\Vite;

/**
 * Obtenez un fichier d’entrée vite ou des fichiers groupés.
 *
 * @param string $assets js ou css
 */
function viteTags(string $assets): ?string
{
    if (in_array($assets, ['js', 'css'], true)) {
        return Vite::tags()[$assets];
    }

    return null;
}

/**
 * Recuperer le modulepour React
 */
function getReactModule(): ?string
{
    return Vite::getReactTag();
}

/**
 * @return bool true si vite est en cours d'execution
 */
function viteIsRunning(): bool
{
    $entryFile = env('VITE_ORIGIN') . '/' . env('VITE_RESOURCES_DIR') . '/' . env('VITE_ENTRY_FILE');

    return (bool) @file_get_contents($entryFile);
}

/**
 * Recupere le framework Vite utilisé
 *
 * @return string react, vue, svelte or none
 */
function viteFramework()
{
    return env('VITE_FRAMEWORK');
}
