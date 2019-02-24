<template>
	<div class="panel panel-default" v-if="$store.state.employeeEditable.status">
		<div class="panel-heading">
			Non Activate
		</div>
		<div class="panel-body">
			<form id="non-activate-form">
				<div class="row">
					<div class="col-sm-12">
						<input-text id="employee" :value="$store.state.employee.nin+' - '+$store.state.employee.name" :readonly="true"></input-text>
					</div>
					<div class="col-sm-12">
						<select2 id="reason">
							<option v-for="i in 7" :value="i">{{ non_active(i) }}</option>
						</select2>
					</div>
					<div class="col-sm-12">
						<simpan-btn @click.prevent.native="nonActivate" :saving="saving" text="Non Activate"></simpan-btn>
						<batal-btn @click.native.prevent="cancel"></batal-btn>
					</div>	
				</div>	
			</form>
		</div>
	</div>
</template>
<script>
export default {
	data(){
		return {
			saving : false
		}
	},
	methods : {
		non_active(i){
			switch (i) {
				case 1:return 'Stand Down';break;
				case 2:return 'Chronic Pain';break;
				case 3:return 'Move District';break;
				case 4:return 'Family Reason';break;
				case 5:return 'No Mention';break;
				case 6:return 'Termination Of Employment';break;
				case 7:return 'Other';break;
				default:return 'invalid';break;
			}
		},
		cancel() {
			this.$store.state.employeeEditable = {
				status : false,
				id : null
			}
		},
		nonActivate(){
			if(!this.saving){
				this.saving = true
				this.$store.dispatch('nonActivate', $('#non-activate-form').serialize()).then(() => {
					this.saving = false
				})
			}
		}
	}
}
</script>