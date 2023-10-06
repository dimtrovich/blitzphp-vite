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

BlitzPHP Vite is a package that aims to integrate [vitejs](https://vitejs.dev/) with [BlitzPHP](http://blitz-php.byethost14.com/) in a simple way.

## Features:
 - ⏱️ Almost zero configuration
 - 🧩 Easy to install and remove
 - 🔨 Easy to customize
 - ✌️ Support most used frameworks: `react`, `vue`, and `svlete`.
 - 🔥 Enjoy hot module replacement (HMR)
 
## Installation:

```
composer require dimtrovich/blitzphp-vite
```

then from your project root, run:

```
php klinge vite:init --framework=<framework>
```

replace `<framework>` with `vue`, `react`, `svelte`, or `none`

or you can just run:

```
php klinge vite:init
```

our buddy `klinge` will handle the rest for you 🙃

## Getting Started:
- Install your node dependencies: `npm install`
- Start vite server: `npm run dev`
- Start CI server: `php klinge serve` or access it through your virtual host.
- That's all =)

> **NOTE:**
> 
> `npm run dev` is not where you should work, it main purpose is to serve assets, such as scripts or stylesheets.
> once you build your files, it becomes useless
> but as long as it running, the package will use it instead of the bundled files.
> So make sure to **access your project** from ci server or a vitual host.

## Build your files:

to bundle your files, run: 
```
npm run build
```
this command will generate the bundled assets in your public directory. 
but as we said before, as long as vite server is running, the package will use it instead of bundled files, so make sure to stop it when you're done developing.

## Uninitialize:

`composer remove dimtrovich/blitzphp-vite` command will remove the package, but the generated files will remain there (package.json, vite.config.js ...etc).
so to avoid that, make sure to run the following command first:

```
php klinge vite:remove
```
This command will do the following:
- delete `package.json`, `packages.lock.json` and `vite.config.js`.
- delete `resources` folder.
- And finally restore your `.env` file.

## 🔥 Need a quick start?
Check out our starter apps for [svelte](https://github.com/dimtrovich/ci-svelte-appstarter) and [vue](https://github.com/dimtrovich/ci-vue-appstarter).

<a href="https://github.com/dimtrovich/ci-svelte-appstarter">
	<img width="120px" src="https://github.com/dimtrovich/ci-svelte-appstarter/raw/master/ci-svelte.webp">
</a>
<a href="https://github.com/dimtrovich/ci-vue-appstarter">
	<img width="120px" src="https://github.com/dimtrovich/ci-vue-appstarter/raw/master/ci-vue.webp">
</a> 

## Contributing
All contributions are welcome, it doesn't matter whether you can code, write documentation, or help find bugs.
feel free to use issues or pull requests.

## Support
Unfortunately, I don't drink coffee 💔, but you can star it instead 🙃

## License

MIT License &copy; 2023 [Dimitri Sitchet Tomkeu](https://github.com/dimtrovich)
