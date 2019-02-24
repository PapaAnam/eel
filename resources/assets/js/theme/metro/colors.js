export default {
	colors : [
	'black', 'white', 'lime', 'green', 'emerald', 'teal', 'blue', 'cyan', 'cobalt', 'indigo', 'violet',
	'pink', 'magenta', 'crimson', 'red', 'orange', 'amber', 'yellow', 'brown', 'olive',
	'steel', 'mauve', 'taupe', 'gray', 'dark', 'darker', 'darkBrown', 'darkCrimson',
	'darkMagenta', 'darkIndigo', 'darkCyan', 'darkCobalt', 'darkTeal', 'darkEmerald',
	'darkGreen', 'darkOrange', 'darkRed', 'darkPink', 'darkViolet', 'darkBlue',
	'lightBlue', 'lightRed', 'lightGreen', 'lighterBlue', 'lightTeal', 'lightOlive',
	'lightOrange', 'lightPink', 'grayDark', 'grayDarker', 'grayLight', 'grayLighter'
	],
	area_schemes : [
	'tile-area-scheme-dark', 'tile-area-scheme-dark', 'tile-area-scheme-darkBrown', 'tile-area-scheme-darkBrown',
	'tile-area-scheme-darkCrimson', 'tile-area-scheme-darkCrimson', 'tile-area-scheme-darkViolet', 'tile-area-scheme-darkViolet',
	'tile-area-scheme-darkMagenta', 'tile-area-scheme-darkMagenta', 'tile-area-scheme-darkCyan', 'tile-area-scheme-darkCyan', 
	'tile-area-scheme-darkCobalt', 'tile-area-scheme-darkCobalt', 'tile-area-scheme-darkTeal', 'tile-area-scheme-darkTeal',
	'tile-area-scheme-darkEmerald', 'tile-area-scheme-darkEmerald', 'tile-area-scheme-darkGreen', 'tile-area-scheme-darkGreen',
	'tile-area-scheme-darkOrange', 'tile-area-scheme-darkOrange', 'tile-area-scheme-darkRed', 'tile-area-scheme-darkRed',
	'tile-area-scheme-darkPink', 'tile-area-scheme-darkPink', 'tile-area-scheme-darkIndigo', 'tile-area-scheme-darkIndigo',
	'tile-area-scheme-darkBlue', 'tile-area-scheme-darkBlue', 'tile-area-scheme-lightBlue', 'tile-area-scheme-lightBlue',
	'tile-area-scheme-lightTeal', 'tile-area-scheme-lightTeal', 'tile-area-scheme-lightOlive', 'tile-area-scheme-lightOlive',
	'tile-area-scheme-lightOrange', 'tile-area-scheme-lightOrange', 'tile-area-scheme-lightPink', 'tile-area-scheme-lightPink',
	'tile-area-scheme-grayed', 'tile-area-scheme-grayed',
	],
	getBgRandom(){
		return 'bg-'+this.colors[Math.floor(Math.random(1)*this.colors.length)]
	},
	getRandomColor(){
		return this.colors[Math.floor(Math.random(1)*this.colors.length)]
	},
	getRandomScheme(){
		return this.area_schemes[Math.floor(Math.random(1)*this.area_schemes.length)]
	}
}