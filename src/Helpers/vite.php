<?php

use Dimtrovich\BlitzPHP\Vite\Vite;

/**
 * Obtenez un fichier d’entrée vite ou des fichiers groupés.
 * 
 * @param string js ou css
 */
function viteTags(string $assets): ?string
{
    if (in_array($assets, ['js', 'css'])) {
        return Vite::tags()[$assets];
    }

    return null;
}

/**
 * Recuperer le modulepour React
 * 
 * @return string|null
 */
function getReactModule(): ?string
{
    return vite::getReactTag();
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
