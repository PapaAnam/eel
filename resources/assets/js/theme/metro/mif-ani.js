export default {
	animations : [
	'mif-ani-spanner',
	'mif-ani-bell',
	'mif-ani-vertical',
	'mif-ani-horizontal',
	'mif-ani-flash',
	'mif-ani-bounce',
	'mif-ani-float',
	'mif-ani-heartbeat',
	'mif-ani-shake',
	'mif-ani-shuttle',
	'mif-ani-pass',
	'mif-ani-ripple',
	],
	spin : [
	'mif-ani-spin',
	'mif-ani-pulse',
	],
	speed : [ '', 'mif-ani-slow', 'mif-ani-fast'
	],
	getRandomSpeed(){
		return this.speed[Math.floor(Math.random(1)*this.speed.length)]
	},
	getRandomAnimation(){
		return this.animations[Math.floor(Math.random(1)*this.animations.length)]
	},
}