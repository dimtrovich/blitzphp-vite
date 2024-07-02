<?php

/**
 * This file is part of Blitz PHP Vite.
 *
 * (c) 2024 Dimitri Sitchet Tomkeu <devcode.dst@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Dimtrovich\BlitzPHP\Vite\Commands;

use BlitzPHP\Autoloader\Autoloader;
use BlitzPHP\Cli\Console\Command;
use BlitzPHP\Cli\Console\Console;
use BlitzPHP\Container\Services;
use BlitzPHP\Publisher\Publisher;
use Psr\Log\LoggerInterface;
use Symfony\Component\Finder\SplFileInfo;
use Throwable;

/**
 * @credit <a href="https://github.com/mihatorikei/codeigniter-vitejs">codeigniter-vitejs</a>
 */
class Init extends Command
{
    protected $group       = 'BlitzPHP Vite';
    protected $name        = 'vite:init';
    protected $description = 'Initialise le package BlitzPHP Vite';

    /**
     * {@inheritDoc}
     */
    protected $options = [
        '--framework' => 'Le nom du framework à utiliser.',
    ];

    private ?string $framework = null;

    /**
     * @var string[]
     */
    private array $supportedFrameworks = ['none', 'react', 'vue', 'svelte'];

    private string $path;

    public function __construct(Autoloader $autoloader, protected Console $app, protected LoggerInterface $logger)
    {
        parent::__construct($app, $logger);
        $this->path = $autoloader->getNamespace('Dimtrovich\\BlitzPHP\\Vite')[0];
    }

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    public function execute(array $params)
    {
        $this->write('Initialisation du package BlitzPHP Vite⚡')->eol();

        // Definition du framework.
        if (empty($this->framework = $this->option('framework'))) {
            $this->framework = $this->choice('Choisissez un framework: ', $this->supportedFrameworks);
        }

        $this->eol();

        // Mais que se passe-t-il si l'utilisateur sélectionne un framework non pris en charge ?!
        // si c'est vrai, renvoie un message d'erreur avec les frameworks disponibles.
        if (! in_array($this->framework, $this->supportedFrameworks, true)) {
            $this->fail("❌ Désolé, mais {$this->framework} n'est pas pris en charge!");
            $this->writer->colors('<red>Les frameworks disponibles sont: </end>');
            $this->colorize(implode(', ', $this->supportedFrameworks), 'green');

            return;
        }

        // Générons maintenant les fichiers vite nécessaires (vite.config.js, package.json ... etc).
        $this->generateFrameworkFiles();

        // Mettez à jour le fichier .env.
        $this->updateEnvFile();

        // Tout est prêt maintenant.
        $this->ok('BlitzPHP Vite initialisé avec succès ✅')->eol();
        $this->eol()->write('Executer: npm install && npm run dev');
    }

    /**
     * Générer des fichiers vite (vite.config.js, package.json & resources ...etc)
     *
     * @return void
     */
    private function generateFrameworkFiles()
    {
        $this->io->warn('⚡ Génération des fichiers vite...', true);

        // Fichiers de framework.
        $frameworkPath = ($this->framework === 'none') ? 'Frameworks/default' : "Frameworks/{$this->framework}";

        $frameworkFiles = array_map(
            static fn (SplFileInfo $file) => $file->getRelativePathname(),
            Services::fs()->allFiles($this->path . $frameworkPath, true)
        );

        $publisher = new Publisher($this->path . $frameworkPath, ROOTPATH);

        // Publication des fichier.
        try {
            $publisher->addPaths($frameworkFiles)->merge(true);
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            return;
        }

        $this->success('Les fichiers Vite sont prêts ✅')->newLine();
    }

    /**
     * Set vite configs in .env file
     *
     * @return void
     */
    private function updateEnvFile()
    {
        $this->io->warn('Mise à jour du fichier .env...', true);

        // Obtenez le fichier env.
        $envFile = ROOTPATH . '.env';

        // Sauvegarde
        $backupFile = is_file($envFile) ? 'env-BACKUP-' . time() : null;

        // Existe? sinon, générez-le =)
        if (is_file($envFile)) {
            // Mais d'abord, faisons une sauvegarde.
            copy($envFile, ROOTPATH . $backupFile);

            // Obtenir le contenu de .env.default
            $content = file_get_contents($this->path . 'Config/env.default');

            // Append it.
            file_put_contents($envFile, "\n\n{$content}", FILE_APPEND);
        } else {
            // Comme nous l'avons déjà dit, générez-le.
            copy($this->path . 'Config/env.default', ROOTPATH . '.env');
        }

        // définissez le nom de la sauvegarde dans celui actuel.
        if ($backupFile) {
            $envContent   = file_get_contents(ROOTPATH . '.env');
            $backupUpdate = str_replace('VITE_BACKUP_FILE=', "VITE_BACKUP_FILE='{$backupFile}'", $envContent);
            file_put_contents($envFile, $backupUpdate);
        }

        // Définir le framework.
        if ($this->framework !== 'none') {
            // Obtenez du contenu .env.
            $envContent = file_get_contents($envFile);
            // Définir le cadre.
            $updates = str_replace("VITE_FRAMEWORK='none'", "VITE_FRAMEWORK='{$this->framework}'", $envContent);

            file_put_contents($envFile, $updates);

            // React entry file (main.jsx).
            if ($this->framework === 'react') {
                $envContent = file_get_contents($envFile);
                $updates    = str_replace("VITE_ENTRY_FILE='main.js'", "VITE_ENTRY_FILE='main.jsx'", $envContent);
                file_put_contents($envFile, $updates);
            }
        }

        // env modifié.
        $this->success('.env file modifié ✅')->newLine();
    }
}
