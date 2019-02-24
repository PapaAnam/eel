<template>
	<div>
		<div class="mac">
			<mac-header title="Employee Edit" icon="fa fa-address-book-o mif-ani-shuttle"></mac-header>
			<div class="mac-content">
				<div class="row">
					<div class="col-md-12 mb-2">
						<router-link to="/employees">
							<batal-btn></batal-btn>
						</router-link>
						<simpan-btn @click.native.prevent="simpan" :saving="saving"></simpan-btn>
					</div>
					<div class="col-md-12">
						<form id="edit-form" role="form" enctype="multipart/form-data">
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
					</div>
				</div>
			</div>
			<div class="mac-footer"></div>
		</div>
		<!-- <mac-preloader icon="fa fa-address-book-o mif-ani-shuttle" :bg="bgTiles.employee"></mac-preloader> -->
	</div>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	import empTab from './emp-tab'
	export default {
		data(){
			return {
				saving : false
			}
		},
		computed : {
			...mapGetters([
				'bgTiles',
				'employee'
				]),
			img(){
				return baseDomain('/storage/'+this.employee.photo)
			}
		},
		methods : {
			...mapActions([
				'updateEmployee'
				]),
			simpan(){
				if(!this.saving){
					this.saving = true
					let data = new FormData(document.getElementById('edit-form'))
					this.updateEmployee(data).then(()=>{
						this.saving = false
						setTimeout(()=>{
							this.$router.push({
								name : 'employees'
							})	
						}, 2000)
					})
				}
			}
		},
		watch : {
			'$store.getters.employee'(){
				setTimeout(()=>{
					$('#salary_group').val(this.$store.getters.employee.salary_group)
				}, 1000)
			}
		},
		created(){
			this.$store.dispatch('getEmployee', this.$route.params.id)
			// console.log(this.$route.params.id)
			this.$store.state.employeeEditable = {
				status : true,
				id : this.$route.params.id
			}
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