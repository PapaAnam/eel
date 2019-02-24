<template>
	<my-card title="New" class="mb-2">
		<form id="add-form" role="form" method="post">
			<div class="row">
				<div class="col-md-12">
					<input-tags id="name"></input-tags>
				</div>
				<div class="col-md-12">
					<simpan-btn @click.native.prevent="simpan" :saving="saving"></simpan-btn>
				</div>
			</div>
		</form>
	</my-card>
</template>

<script>
import { mapActions } from 'vuex'
export default{
	data(){
		return {
			saving : false	
		}
	},
	methods : {
		...mapActions([
			'savePosition'
			]),
		simpan(){
			if(!this.saving){
				this.saving = true
				this.savePosition([$('#add-form').serialize(), '#add-form']).then(()=>{
					this.saving = false
					this.$store.dispatch('refreshPosition')
				})
			}
		}
	},
	created(){
	}
}
</script>