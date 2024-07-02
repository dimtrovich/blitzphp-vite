/* eslint-disable sort-keys */
/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution')

module.exports = {
	root: true,
	parserOptions: {
	  	ecmaVersion: 'latest',
	},
	env: {
	  	node: true,
  	},
  	extends: [
    	'plugin:vue/vue3-strongly-recommended',
    	'eslint:recommended',
    	'@vue/eslint-config-prettier/skip-formatting',
		'prettier',
  	],
	plugins: [
		'@stylistic/js',
	],
   	rules: {
        'vue/comma-dangle': ['error', 'always-multiline'],
        'comma-dangle': ['error', 'always-multiline'],
        semi: ['error', 'never'],
		camelcase: ['error', { ignoreDestructuring: true, ignoreImports: true, ignoreGlobals: true }],
		'no-else-return': ['error', { allowElseIf: false }],
		'no-empty': ['error', { allowEmptyCatch: true }],
		'no-empty-function': ['error'],
		'object-shorthand': ['error', 'always', { avoidExplicitReturnArrows: true, avoidQuotes: true }],
		'prefer-const': ['error', { destructuring: 'all' }],
		'prefer-destructuring': ['error', { 'array': false, 'object': true }, { enforceForRenamedProperties: true }],
		'prefer-object-spread': 'error',
		'sort-imports': ['error', { ignoreCase: true, allowSeparatedGroups: true }],
		'sort-keys': ['error', 'asc', { natural: true, caseSensitive: false }],
		'sort-vars': ['error', { ignoreCase: true }],
		'@stylistic/js/semi-spacing': 'error',
		'@stylistic/js/no-extra-parens': ['error', 'all', { nestedBinaryExpressions: false, ternaryOperandBinaryExpressions: false }],
		'@stylistic/js/space-before-function-paren': ['error', { anonymous: 'never', named: 'never', asyncArrow: 'ignore' }],
		'@stylistic/js/keyword-spacing': 'error',
		'@stylistic/js/object-curly-spacing': ['error', 'always'],
		'@stylistic/js/array-bracket-spacing': ['error', 'never'],
		'@stylistic/js/quotes': ['error', 'single'],
		'@stylistic/js/space-unary-ops': 'error',
		'@stylistic/js/spaced-comment': ['error', 'always'],
        'no-mixed-operators': [
            'error',
            {
                'groups': [
                    ['&', '|', '^', '~', '<<', '>>', '>>>'],
                    ['==', '!=', '===', '!==', '>', '>=', '<', '<='],
                    ['&&', '||'],
                    ['in', 'instanceof'],
                ],
                'allowSamePrecedence': true,
            },
        ],
        'curly': [1, 'all'],
        'brace-style': [2, '1tbs'],
    },
}
