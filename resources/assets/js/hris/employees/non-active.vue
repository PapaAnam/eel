<template>
	<div class="mac">
		<mac-header title="Non Active Employees" icon="fa fa-address-book-o mif-ani-shuttle"></mac-header>
		<div class="mac-content">
			<div class="row">
				<div class="col-md-12">
					<router-link to="/employees/new">
						<btn-primary text="New"></btn-primary>
					</router-link>
					<router-link to="/employees">
						<btn-primary text="All Employee"></btn-primary>
					</router-link>
				</div>
				<div class="col-md-12">
					<employees-non-active-view></employees-non-active-view>
				</div>
			</div>
		</div>
		<div class="mac-footer"></div>
	</div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	mounted(){
		this.$store.dispatch('showView')
	}
}
</script>