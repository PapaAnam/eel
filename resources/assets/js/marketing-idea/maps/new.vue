<template>
	<b-card header="New" class="mb-2" header-bg-variant="primary" header-text-variant="white">
		<form id="add-form">
			<b-row>
				<b-col lg="12">
					<input-tags id="name"></input-tags>
				</b-col>
				<b-col lg="12" v-if="$store.getters.departmentBaru.id">
					<input-text :readonly="true" id="department" :value="$store.getters.departmentBaru.name"></input-text>
					<input type="hidden" name="dibawahi" :value="$store.getters.departmentBaru.id">
				</b-col>
				<b-col lg="12">
					<simpan-btn @click.native.prevent="simpan" :saving="saving"></simpan-btn>
				</b-col>
			</b-row>
		</form>
	</b-card>
</template>

<script>
import { mapActions } from 'vuex'
export default{
	data(){
		return {
			saving : false
		}
	},
	props : [],
	mounted(){
		$('#add-form').find(".multiple").select2({
			tags : true
		});
	},
	methods : {
		...mapActions([
			'saveDept'
			]),
		simpan(){
			if(!this.saving){
				this.saving = true
				this.saveDept(new FormData(document.getElementById('add-form')))
				.then(()=>{
					this.saving = false
				})
			}
		}
	}
}
</script>