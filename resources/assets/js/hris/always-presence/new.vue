<template>
	<form id="add-form" class="mb-2" role="form" method="post">
		<my-card title="Cash Withdrawal Form">
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<employees-select id="applicant_id" label="Applicant"></employees-select>
				</div>
				<div class="col-lg-4 col-md-6">
					<inp type="number" id="total"></inp>
				</div>
				<div class="col-lg-4 col-md-6">
					<inp type="number" id="installment"></inp>
				</div>
				<div class="col-sm-12">
					<textar id="reason"></textar>
				</div>
				<div class="col-lg-3 col-md-6">
					<months-select id="month_start" label="Month Start"></months-select>
				</div>
				<div class="col-lg-3 col-md-6">
					<years-select id="year_start" label="Year Start"></years-select>
				</div>
				<div class="col-lg-3 col-md-6">
					<months-select id="month_end" label="Month End"></months-select>
				</div>
				<div class="col-lg-3 col-md-6">
					<years-select id="year_end" label="Year End"></years-select>
				</div>
				<div class="col-lg-4 col-md-6">
					<employees-select id="hrd_id" label="HRD"></employees-select>
				</div>
				<div class="col-lg-4 col-md-6">
					<employees-select id="manager_id" label="Manager"></employees-select>
				</div>
				<div class="col-sm-12">
					<simpan-btn v-if="!editable" @click.native.prevent="simpan" :saving="saving"></simpan-btn>
					<simpan-btn v-if="editable" @click.native.prevent="perbarui" :saving="saving"></simpan-btn>
				</div>
			</div>
		</my-card>
	</form>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'
	export default{
		data(){
			return {
				saving : false,
			}
		},
		props : {
			data : {
				type : Object
			},
			editable : {
				type : Boolean,
				default : false,
			}
		},
		methods : {
			simpan(){
				if(!this.saving){
					resetAllError()
					this.saving = true
					let data = new FormData(document.getElementById('add-form'))
					myaxios.post('cash-withdrawal', data).then(res=>{
						this.saving = false
						successMsg(res.data)
						this.$emit('refresh')
					}).catch(err=>{
						this.saving = false
						handleError(err, '#add-form')
					})
				}
			},
			perbarui(){
				if(!this.saving){
					resetAllError()
					this.saving = true
					let data = new FormData(document.getElementById('add-form'))
					data.append('_method', 'PUT')
					myaxios.post('cash-withdrawal/'+this.data.id, data).then(res=>{
						this.saving = false
						successMsg(res.data)
						this.$emit('refresh')
					}).catch(err=>{
						this.saving = false
						handleError(err, '#add-form')
					})
				}
			}
		},
		computed : {
		},
		created(){
		},
		mounted(){
			setTimeout(() => {
				$(this.$el).find('#check-all').on('ifChecked', function(event){
					$('#add-form').find('[type="checkbox"]').iCheck('check');
				});
				$(this.$el).find('#check-all').on('ifUnchecked', function(event){
					$('#add-form').find('[type="checkbox"]').iCheck('uncheck');
				});
			}, 2000)
		}
	}
</script>