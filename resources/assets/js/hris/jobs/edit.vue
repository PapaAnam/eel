<template>
	<my-card title="Edit">
		<form id="edit-form" role="form" method="post">
			<div class="row">
				<div class="col-md-12">
					<input-text id="name" label="Name" :value="$store.state.position.name"></input-text>
				</div>
				<div class="col-md-12">
					<simpan-btn @click.native.prevent="update" :saving="saving"></simpan-btn>
					<batal-btn @click.native.prevent="cancel"></batal-btn>
				</div>
			</div>
		</form>
	</my-card>
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
			'position'
			])
	},
	methods : {
		update(){
			if(!this.saving){
				this.saving = true
				this.$store.dispatch('updatePosition', $('#edit-form').serialize()).then(()=>{this.saving=false})
			}
		},
		cancel(){
			this.$store.state.positionEditable = {
				status : false,
				id : null
			}
		}
	},
	watch : {
		id(id){
			this.$store.dispatch('getPosition', id)
		}
	},
	created(){
		this.$store.dispatch('getPosition', this.id)
	}
}
</script>