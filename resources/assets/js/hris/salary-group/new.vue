<template>
	<form id="add-form" class="mb-2" role="form" method="post">
		<div class="row">
			<div class="col-md-12">
				<my-card title="Enter Form">
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-md-6">
									<input-text v-model="data.name" id="name"></input-text>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<icheck id="check-all" label="Check All"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="basic_salary" :checked="data ? data.basic_salary == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck label="Allowance" id="allowance" :checked="data ? data.allowance == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="ot_regular" :checked="data ? data.ot_regular == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="ot_holiday" :checked="data ? data.ot_holiday == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="incentive" :checked="data ? data.incentive == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="food_allowance" :checked="data ? data.food_allowance == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="rent_motorcycle" :checked="data ? data.rent_motorcycle == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="retention" :checked="data ? data.retention == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="tax_insurance" :checked="data ? data.tax_insurance == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="seguranca_social" :checked="data ? data.seguranca_social == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="cash_withdrawal" :checked="data ? data.cash_withdrawal == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="absent" :checked="data ? data.absent == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="etc" :checked="data ? data.etc == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-6 col-md-3">
							<icheck id="thr" :checked="data ? data.thr == 1 : false" :delay="data ? 1000 : 0" value="1"></icheck>
						</div>
						<div class="col-sm-12">
							<simpan-btn v-if="!editable" @click.native.prevent="simpan" :saving="saving"></simpan-btn>
							<simpan-btn v-if="editable" @click.native.prevent="perbarui" :saving="saving"></simpan-btn>
						</div>
					</div>
				</my-card>
			</div>
		</div>
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
				default : {

				},
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
					myaxios.post('salary-group', data).then(res=>{
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
					myaxios.post('salary-group/'+this.data.id, data).then(res=>{
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