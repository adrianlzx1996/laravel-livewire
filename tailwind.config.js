/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
	],
	safelist: [
		{
			pattern: /text-(red|green|blue|slate)-(500|600|700|800|900)/,
		},
		{
			pattern: /bg-(red|green|blue|slate)-(100|200|300)/,
		},
	],
	theme: {
		extend: {},
	},
	plugins: [],
}
