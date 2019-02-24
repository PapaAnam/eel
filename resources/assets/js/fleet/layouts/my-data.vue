<template>
	<div v-if="$slots.default === undefined">
		<div style="overflow:auto;" class="pb-20" v-if="!processing">
			<template v-if="data.length > 0">
				<my-dt>	
					<thead>
						<tr>
							<th width="10px">#</th>
							<th v-for="(d, key) in data[0]">
								{{ key }}
							</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(d, i) in data">
							<td>{{ ++i }}</td>
							<td v-for="(dd, key) in d">
								{{ dd }}
							</td>
						</tr>
					</tbody>
				</my-dt>
			</template>
			<template v-else>
				<div class="bg-lightRed p-10 block-shadow-danger">
					No data available
				</div>
			</template>
		</div>
		<div v-else>
			<div class="bg-lighterBlue p-10 block-shadow-info">
				Getting data from server
			</div>
		</div>
	</div>
	<div v-else>
		<slot v-if="!action"></slot>
		<template v-else>
			<div style="overflow:auto;" class="pb-20" v-if="!processing">
				<template v-if="action.length > 0">
					<my-dt>	
						<slot></slot>
					</my-dt>
				</template>
				<template v-else>
					<div class="bg-lightRed p-10 block-shadow-danger">
						No data available
					</div>
				</template>
			</div>
			<div v-else>
				<div class="bg-lighterBlue p-10 block-shadow-info">
					Getting data from server
				</div>
			</div>
		</template>
	</div>
</template>
<script>
import { mapGetters, mapActions, mapMutations } from 'vuex'
export default {
	props : ['data', 'action'],
	data(){
		return {
		}
	},
	computed : {
		...mapGetters([
			'processing'
			])
	},
	methods : {
		...mapActions([
			
			]),
		...mapMutations([
			
			])
	},
	created(){
	},
	mounted(){
		// console.log(this.$slots.default)
	}
}
</script>