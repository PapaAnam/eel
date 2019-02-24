<template>
	<div class="mac">
		<mac-header title="Edit Account" icon="fa fa-user-circle-o mif-ani-float"></mac-header>
		<div class="mac-content">
			<form id="edit-form" role="form" method="post">
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<my-card title="Account">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<select2 id="level">
											<option value="2" :selected="account.level == 2">Admin</option>
											<option value="3" :selected="account.level == 3">Supervisor</option>
											<option value="4" :selected="account.level == 4">Manager</option>
										</select2>
									</div>
								</div>
								<div class="col-sm-12">
									<input-text id="username" :value="account.username"></input-text>
								</div>
								<div class="col-sm-12">
									<input-pass></input-pass>
								</div>
								<div class="col-sm-12">
									<input-pass id="password_confirmation"></input-pass>
								</div>
								<div class="col-sm-12">
									<div class="alert alert-info">
										Keep blank password if do not want to change
									</div>
								</div>
							</div>
						</my-card>
					</div>
					<div class="col-sm-6 col-md-8">
						<accounts-authority></accounts-authority>
					</div>
					<div class="col-md-12 mt-2">
						<router-link to="/accounts">
							<batal-btn></batal-btn>
						</router-link>
						<simpan-btn text="Update" @click.native.prevent="simpan" :saving="saving"></simpan-btn>
					</div>
				</div>
			</form>
		</div>
		<div class="mac-footer"></div>
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
		...mapActions([
			'updateAccount'
			]),
		simpan(){
			if(!this.saving){
				this.saving = true
				this.updateAccount(new FormData(document.getElementById('edit-form'))).then(()=>{
					this.saving = false
					this.$store.dispatch('refreshAccount')
				})
			}
		}
	},
	computed : {
		...mapGetters([
			'account'
			])
	},
	created(){
		this.$store.dispatch('getAccount', this.$route.params.id)
		this.$store.state.accountsEditable = {
			status : true,
			id : this.$route.params.id
		}
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
		$('.hint2').hide()
	}
}
</script>