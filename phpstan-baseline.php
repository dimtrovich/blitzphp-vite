<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
	// identifier: property.notFound
	'message' => '#^Access to an undefined property object\\:\\:\\$file\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Vite.php',
];
$ignoreErrors[] = [
	// identifier: constant.notFound
	'message' => '#^Constant WEBROOT not found\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Vite.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
