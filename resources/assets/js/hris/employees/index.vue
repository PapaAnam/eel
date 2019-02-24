<template>
	<div class="mac">
		<mac-header title="Employees" :icon="$store.getters.modul.employee.icon"></mac-header>
		<div class="mac-content">
			<b-tabs>
				<b-tab title="Active" active>
					<employees-view></employees-view>
				</b-tab>
				<b-tab title="New">
					<niu></niu>
				</b-tab>
				<b-tab title="Non Active">
					<non-active></non-active>
				</b-tab>
			</b-tabs>
		</div>
		<div class="mac-footer"></div>
	</div>
</template>
<script>
	import niu from './new'
	import nonActive from './non-active-view'
	import { mapGetters, mapActions } from 'vuex'
	export default {
		computed : {
			...mapGetters(['employees', 'bgTiles'])
		},
		created(){
			this.$store.state.employeeEditable = {
				status : false,
				id : null
			}
		},
		components : {
			niu, nonActive
		},
		mounted(){
			this.$store.dispatch('showView')
		}
	}
</script>