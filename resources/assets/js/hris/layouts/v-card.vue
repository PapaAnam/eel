<template>
	<div>
		<my-card v-if="typeof data == 'object' && data.length > 0" :title="title">
			<slot></slot>
		</my-card>
		<template v-else-if="data == 'processing'">
			<b-alert show variant="info">
				Processing
			</b-alert>
		</template>
		<template v-else>
			<b-alert show variant="danger">
				Data not available
			</b-alert>
		</template>
	</div>
</template>
<script>
export default {
	data(){
		return {
			
		}
	},
	props : ['data', 'title'],
	watch : {
		data(val){
		}
	},
	computed : {

	},
	methods : {

	},
	created(){

	},
	mounted(){

	}
}
</script>