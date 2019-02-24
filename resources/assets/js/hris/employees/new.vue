<template>
	<b-row class="mt-2">
		<b-col lg="12">
			<form id="add-form" role="form" enctype="multipart/form-data">
				<div class="tabcontrol2" data-role="tabcontrol">
					<emp-tab></emp-tab>
					<div class="frames">
						<div class="frame" id="biography">
							<biography></biography>
						</div>
						<div class="frame" id="placement">
							<placement></placement>
						</div>
						<div class="frame" id="family_background">
							<family></family>
						</div>
						<div class="frame" id="educational_history">
							<educational-history></educational-history>
						</div>
						<div class="frame" id="important_file">
							<important-file></important-file>
						</div>
					</div>
				</div>
			</form>
			<b-row>
				<div class="col-md-12 mt-2">
					<router-link to="/employees">
						<batal-btn></batal-btn>
					</router-link>
					<simpan-btn @click.native.prevent="simpan" :saving="saving"></simpan-btn>
				</div>
			</b-row>
		</b-col>
	</b-row>
</div>
</template>
<script>
	import empTab from './emp-tab'
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				saving : false
			}
		},
		computed : {
			...mapGetters([
				'bgTiles'
				])
		},
		methods : {
			...mapActions(['saveEmployee']),
			simpan(){
				if(!this.saving){
					this.saving = true
					let data = new FormData(document.getElementById('add-form'))
					this.saveEmployee([data, '#add-form']).then(()=>{
						this.saving = false
						this.$store.dispatch('refreshEmployee')
					})
				}
			}
		},
		created(){
			this.$store.state.employee = ''
		},
		mounted(){
			this.$store.dispatch('showView')
			fadeOutPreloader()
		},
		components : {
			empTab
		}
	}
</script>