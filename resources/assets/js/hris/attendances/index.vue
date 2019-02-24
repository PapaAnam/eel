<template>
	<div class="mac">
		<mac-header title="Manage Attendance" :icon="$store.getters.modul.attendance.icon"></mac-header>
		<div class="mac-content">
			<b-tabs>
				<b-tab title="By Date" active>
					<attendances-view class="mt-2"></attendances-view>
				</b-tab>
				<b-tab title="By Employee">
					<by-employee class="mt-2"></by-employee>
				</b-tab>
				<b-tab title="New">
					<niu class="mt-2"></niu>
				</b-tab>
				<b-tab title="X100C">
					<x100c class="mt-2"></x100c>
				</b-tab>
				<b-tab title="ZT1300">
					<zt1300 class="mt-2"></zt1300>
				</b-tab>
			</b-tabs>
		</div>
		<div class="mac-footer"></div>
	</div>
</template>
<script>
	import niu from './new'
	import byEmployee from './by-employee'
	import x100c from './x100c'
	import zt1300 from './zt1300'
	export default {
		mounted(){
			this.$store.dispatch('showView')
		},
		methods : {
			c(){
				comingSoon()
			}
		},
		components : {
			niu, byEmployee, x100c, zt1300
		}
	}
</script>