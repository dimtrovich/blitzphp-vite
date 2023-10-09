<div align="center">
	<img width="160px" src="src/logo.png">
  	<h1>BlitzPHP + viteJs</h1>
  	<p>Integration de ViteJs pour BlitzPHP</p>
	<p>
		<a href="https://github.com/dimtrovich/blitzphp-vite/releases">
			<img src="https://custom-icon-badges.herokuapp.com/github/v/release/dimtrovich/blitzphp-vite?logo=tag">
		</a>
		<a href="https://github.com/vitejs/awesome-vite#blitzphp">
<img src="https://awesome.re/mentioned-badge.svg">
</a>
<img src="https://custom-icon-badges.herokuapp.com/packagist/stars/dimtrovich/blitzphp-vite?logo=star">
		<a href="https://packagist.org/packages/dimtrovich/blitzphp-vite">
			<img src="https://badges.hiptest.com:/packagist/dt/dimtrovich/blitzphp-vite?color=%23c700ff&logo=packagist&logoColor=%23c700ff">
		</a>
		<a href="LICENSE">
			<img src="https://custom-icon-badges.herokuapp.com/packagist/l/dimtrovich/blitzphp-vite?logo=law">
		</a>
	</p>
</div>

BlitzPHP Vite est un package qui vise à intégrer [vitejs](https://vitejs.dev/) avec [BlitzPHP](http://blitz-php.byethost14.com/) de manière simple.

## Caractéristiques:
  - ⏱️ Configuration quasi nulle
  - 🧩 Facile à installer et à supprimer
  - 🔨 Facile à personnaliser
  - ✌️ Prise en charge des frameworks les plus utilisés : `react`, `vue` et `svlete`.
  - 🔥 Profitez du remplacement du module à chaud (HMR) 
## Installation:

```
composer require dimtrovich/blitzphp-vite
```

puis depuis la racine de votre projet, exécutez :

```
php klinge vite:init --framework=<framework>
```

remplacez `<framework>` par `vue`, `react`, `svelte` ou `none`

ou vous pouvez simplement exécuter :

```
php klinge vite:init
```

notre copain `klinge` s'occupera du reste pour vous 🙃

## Commencer:
- Installez vos dépendances de node : `npm install`
- Démarrez le serveur vite : `npm run dev`
- Démarrez le serveur blitzphp: `php klinge serve` ou accédez-y via votre hôte virtuel.
- C'est tout =)

> **NOTE:**
> 
> `npm run dev` n'est pas l'endroit où vous devriez travailler, son objectif principal est de servir des actifs, tels que des scripts ou des feuilles de style.
> une fois que vous construisez vos fichiers, cela devient inutile
> mais tant qu'il sera exécuté, le package l'utilisera à la place des fichiers fournis.
> Assurez-vous donc d'**accéder à votre projet** depuis le serveur BlitzPHP ou un hôte virtuel.

## Construisez vos fichiers :

pour regrouper vos fichiers, exécutez : 
```
npm run build
```
cette commande générera les actifs regroupés dans votre répertoire public.
mais comme nous l'avons déjà dit, tant que le serveur vite est en cours d'exécution, le package l'utilisera à la place des fichiers groupés, alors assurez-vous de l'arrêter lorsque vous aurez terminé le développement.

## Désinitialiser :

La commande `composer remove dimtrovich/blitzphp-vite` supprimera le package, mais les fichiers générés y resteront (package.json, vite.config.js, etc...).
donc pour éviter cela, assurez-vous d'abord d'exécuter la commande suivante :

```
php klinge vite:remove
```
Cette commande fera ce qui suit :
- supprimer `package.json`, `packages.lock.json` et `vite.config.js`.
- supprimer le dossier `ressources`.
- Et enfin restaurer votre fichier `.env`.

## 🔥 Need a quick start?
Check out our starter apps for [svelte](https://github.com/dimtrovich/ci-svelte-appstarter) and [vue](https://github.com/dimtrovich/ci-vue-appstarter).

<a href="https://github.com/dimtrovich/ci-svelte-appstarter">
	<img width="120px" src="https://github.com/dimtrovich/ci-svelte-appstarter/raw/master/ci-svelte.webp">
</a>
<a href="https://github.com/dimtrovich/ci-vue-appstarter">
	<img width="120px" src="https://github.com/dimtrovich/ci-vue-appstarter/raw/master/ci-vue.webp">
</a> 

## Contributions
Toutes les contributions sont les bienvenues, peu importe que vous sachiez coder, rédiger de la documentation ou aider à trouver des bogues.
n'hésitez pas à utiliser des issues ou des pull request.

## Licence

MIT License &copy; 2023 [Dimitri Sitchet Tomkeu](https://github.com/dimtrovich)
