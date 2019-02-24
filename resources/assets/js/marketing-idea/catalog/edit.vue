<template>
	<b-card header="Edit" header-bg-variant="primary" header-text-variant="white">
		<form id="edit-form" role="form" method="post">
			<b-row>
				<b-col lg="12" v-if="department.dibawahi_oleh">
					<input-text readonly id="primary_department" :value="department.dibawahi_oleh.name"></input-text>
				</b-col>
				<b-col lg="12">
					<input-text id="name" label="Name" :value="department.name"></input-text>
				</b-col>
				<b-col lg="12">
					<simpan-btn @click.native.prevent="update" :saving="saving"></simpan-btn>
					<batal-btn @click.native.prevent="cancel"></batal-btn>
				</b-col>
			</b-row>
		</form>
	</b-card>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
			saving : false
		}
	},
	props : ['id'],
	computed : {
		...mapGetters([
			'department'
			])
	},
	methods : {
		update(){
			if(!this.saving){
				this.saving = true
				this.$store.dispatch('updateDept', new FormData(document.getElementById('edit-form')))
				.then(()=>{
					this.saving=false
				})
			}
		},
		cancel(){
			this.$store.commit('SET_DEPARTMENT_EDITABLE', {
				status : false,
				id : null
			})
		}
	},
	watch : {
		id(id){
			this.$store.dispatch('getDept', id)
		}
	},
	created(){
		this.$store.dispatch('getDept', this.id)
	}
}
</script>