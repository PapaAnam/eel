<template>
	<div class="mac">
		<mac-header title="Departments" :icon="$store.getters.modul.department.icon"></mac-header>
		<div class="mac-content">
			<div class="row">
				<div class="col-md-12">
					<btn-primary @click.prevent.native="baruBanget" text="New"></btn-primary>
				</div>
				<b-col sm="8">
					<department-view ref="dept"></department-view>
				</b-col>
				<b-col sm="4">
					<department-new></department-new>
					<department-edit :id="departmentEditable.id"></department-edit>
				</b-col>
			</div>
		</div>
		<div class="mac-footer"></div>
	</div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
		}
	},
	computed : {
		...mapGetters([
			'departmentEditable', 'bgTiles'
			])
	},
	methods : {
		...mapActions([
			'newDept'
			]),
		baruBanget(){
			if($(window).width() <= 768){
				$('.mac-content').scrollTop(99999)
			}
			this.newDept()
		}
	},
	created(){
	},
	mounted(){
		this.$store.dispatch('showView')
	}
}
</script>