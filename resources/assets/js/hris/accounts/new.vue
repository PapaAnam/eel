<template>
	<div>
		<div class="mac">
			<mac-header title="New Account" :icon="icons.account"></mac-header>
			<div class="mac-content">
				<form id="add-form" class="mb-2" role="form" method="post">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<my-card title="Employee">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<select2 id="level">
												<option value="2">Admin</option>
												<option value="3">Supervisor</option>
												<option value="4">Manager</option>
											</select2>
										</div>
									</div>
									<div class="col-sm-12">
										<input-text id="username"></input-text>
									</div>
									<div class="col-sm-12">
										<input-pass></input-pass>
									</div>
									<div class="col-sm-12">
										<input-pass id="password_confirmation"></input-pass>
									</div>
								</div>
							</my-card>
						</div>
						<div class="col-sm-6 col-md-8">
							<accounts-authority></accounts-authority>
						</div>
					</div>
				</form>
				<simpan-btn @click.native.prevent="simpan" :saving="saving"></simpan-btn>
				<router-link to="/accounts">
					<batal-btn></batal-btn>
				</router-link>
			</div>
			<div class="mac-footer"></div>
		</div>
		<!-- <mac-preloader :icon="icons.account" :bg="bgTiles.account"></mac-preloader> -->
	</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default{
	data(){
		return {
			saving : false	
		}
	},
	methods : {
		...mapActions([ 'saveAccount' ]),
		simpan(){
			if(!this.saving){
				this.saving = true
				let data = new FormData(document.getElementById('add-form'))
				this.saveAccount(data).then(()=>{
					this.saving = false
					this.$store.dispatch('refreshAccount')
				})
			}
		}
	},
	computed : {
		...mapGetters([ 'bgTiles', 'icons' ])
	},
	created(){
		this.$store.state.account = ''
	},
	mounted(){
		this.$store.dispatch('showView')
		// setTimeout(() => {
		// 	$(this.$el).find('#check-all').on('ifChecked', function(event){
		// 		$('#check-menu').find('[type="checkbox"]').iCheck('check');
		// 	});
		// 	$(this.$el).find('#check-all').on('ifUnchecked', function(event){
		// 		$('#check-menu').find('[type="checkbox"]').iCheck('uncheck');
		// 	});
		// }, 2000)
		fadeOutPreloader()
	}
}
</script>