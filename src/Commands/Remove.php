<?php

namespace Dimtrovich\BlitzPHP\Vite\Commands;

use BlitzPHP\Autoloader\Autoloader;
use BlitzPHP\Cli\Console\Command;
use BlitzPHP\Cli\Console\Console;
use BlitzPHP\Container\Services;
use BlitzPHP\Publisher\Publisher;
use Psr\Log\LoggerInterface;
use Symfony\Component\Finder\SplFileInfo;

class Remove extends Command
{
	protected $group        = 'BlitzPHP Vite';
	protected $name         = 'vite:remove';
	protected $description  = 'Supprimer les fichiers et paramètres générés par BlitzPHP Vite';

	private string $path;

	public function __construct(Autoloader $autoloader, protected Console $app, protected LoggerInterface $logger)
    {
        parent::__construct($app, $logger);
		$this->path = $autoloader->getNamespace('Dimtrovich\\BlitzPHP\\Vite')[0];
    }

	public function execute(array $params)
	{
		# debut du netoyage.
		$this->fail('Retrait du package BlitzPHP Vite⚡')->eol();

		# Supprimons maintenant les fichiers vite (vite.config.js, package.json ... etc).
		$this->removeFrameworkFiles();

		# Réinitialisez le fichier .env.
		$this->resetEnvFile();

		# Tout est prêt maintenant.
		$this->ok('BlitzPHP Vite a été supprimé avec succès ✅')->eol();
	}

	/**
	 * Retrait des fichiers Vite (vite.config.js, package.json ...etc).
	 * 
	 * @return void
	 */
	private function removeFrameworkFiles()
	{
		helper('filesystem');

		$this->io->warn('Suppression des fichiers Vite...', true);

		$framework = env('VITE_FRAMEWORK', 'default');

		$frameworkFiles = array_map(
			fn(SplFileInfo $file) => $file->getRelativePathname(), 
			Services::fs()->allFiles($this->path . "Frameworks/$framework", true)
		);
		
		foreach ($frameworkFiles as $file) {
			# Retrait du dossier resources|src.
			if (is_file(ROOTPATH . $file)) {
				unlink(ROOTPATH . $file);
			} elseif (is_dir(ROOTPATH . $file)) {
				(new Publisher(null, ROOTPATH . $file))->wipe();
			} else {
				$this->fail("$file n'existe pas");
			}
		}

		# Retrait de package-lock.json
		is_file(ROOTPATH . 'package-lock.json') 
			? unlink(ROOTPATH . 'package-lock.json') 
			: $this->error('package-lock.json n\'existe pas');

		# Juste au cas où l'utilisateur aurait modifié le répertoire des ressources.
		if (env('VITE_RESOURCES_DIR') && is_dir(ROOTPATH . env('VITE_RESOURCES_DIR'))) {
			(new Publisher(null, ROOTPATH . env('VITE_RESOURCES_DIR')))->wipe();
		}
	}

	/**
	 * Retrait des config vite configs dans le fichier .env
	 * 
	 * @return void
	 */
	private function resetEnvFile()
	{
		$this->io->warn('Restauration du fichier .env ...', true);

		# Obtenez le fichier env.
		$envFile = ROOTPATH . '.env';
		# Obtenez la dernière sauvegarde.
		$backupFile = ROOTPATH . env('VITE_BACKUP_FILE');

		# Existe? sinon, générez-le =)
		if (is_file($backupFile)) {
			# Supprimer le .env actuel
			unlink($envFile);
			# Restaurer la sauvegarde si elle existe
			if (is_file($backupFile)) {
				copy($backupFile, ROOTPATH . '.env');
				unlink($backupFile);
			}
		}
	}
}
