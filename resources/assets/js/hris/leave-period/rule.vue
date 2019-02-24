<template>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="year" id="year">Select Year</label>
						<select v-model="year" class="form-control" name="year" id="year">
							<option v-for="y in years" :value="y">{{ y }}</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Employee From</label>
						<select v-model="is_local" name="is_local" id="" class="form-control">
							<option value="all">All</option>
							<option value="true">Local</option>
							<option value="false">International</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<button @click="get" style="margin-top: 35px;" :class="['btn btn-primary btn-sm', getting ? 'disabled' : '']">
						{{ getting ? 'Getting data from server' : 'View' }}
					</button>
				</div>
			</div>
			<btn-primary v-if="!isEdit" @click.prevent.native="isEdit = true" text="New"></btn-primary>
			<batal-btn v-else @click.prevent.native="isEdit = false"></batal-btn>
			<button @click="getThisYear" :class="['btn btn-primary btn-sm', getting ? 'disabled' : '']">
				{{ getting ? 'Getting data from server' : 'View in '+this_year }}
			</button>
			<my-card title="Form" class="mt-2" v-if="isEdit">
				<form @submit.prevent="simpan" id="add-form" class="mb-2 mt-2" role="form" method="post">
					<b-row>
						<b-col md="4">
							<div class="form-group">
								<label for="">Employee From</label>
								<select v-model="lp.is_local" name="is_local" id="" class="form-control">
									<option value="true">Local</option>
									<option value="false">International</option>
								</select>
							</div>
						</b-col>
						<b-col md="4">
							<div class="form-group">
								<label for="">Status</label>
								<select v-model="lp.status_id" name="status_id" id="" class="form-control">
									<option v-for="s in status" :value="s.id">{{s.status_name}}</option>
								</select>
							</div>
						</b-col>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Maximal <i>(in day)</i></label>
								<input name="qty_max" type="number" min="0" v-model="lp.qty_max" class="form-control">
							</div>
						</div>
						<b-col md="4">
							<div class="form-group">
								<label for="year" id="year">Select Year</label>
								<select v-model="lp.rule_year" class="form-control" name="year" id="year">
									<option v-for="y in years" :value="y">{{ y }}</option>
								</select>
							</div>
						</b-col>
						<b-col md="12">
							<simpan-btn @save="simpan" :saving="saving"></simpan-btn>
						</b-col>
					</b-row>
				</form>
			</my-card>
			<my-card title="Rule Data" class="mt-2">
				<div class="alert alert-info" v-if="getting">
					Getting data from server
				</div>
				<template v-else>
					<table class="table table-bordered table-striped" id="tabel-rule" v-if="leavePeriodRule.length > 0">
						<thead>
							<tr>
								<th width="10px">#</th>
								<th>Employee From</th>
								<th>Year</th>
								<th>Status</th>
								<th>Maximal <i>(in day)</i></th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(s, index) in leavePeriodRule">
								<td>{{ ++index }}</td>
								<td>{{ s.is_local == 'true' ? 'Local' : 'International' }}</td>
								<td>{{ s.rule_year }}</td>
								<td>{{ s.status.status_name }}</td>
								<td>{{ s.qty_max }}</td>
								<td>
									<button @click="edit(s.id)" class="btn btn-primary btn-sm">
										Edit
									</button>
								</td>
							</tr>
						</tbody>
					</table>
					<div v-else class="alert alert-danger">
						Data not found
					</div>
				</template>
			</my-card>
		</div>
	</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'
	export default{
		data(){
			return {
				saving : false,
				eType : 'local',
				leavePeriodRule : [],
				lp : {
					is_local : 'true',
					status_id : 1,
					qty_max : 0,
					rule_year : null,
				},
				isEdit : false,
				getting : false,
				status : [],
				is_local : 'all',
				this_year : (new Date()).getFullYear(),
				years : [],
				year : (new Date()).getFullYear(),
			}
		},
		props : [],
		methods : {
			simpan(){
				if(!this.saving){
					resetAllError()
					this.saving = true
					let data = new FormData(document.getElementById('add-form'))
					data.append('_method', 'PUT')
					myaxios.post('leave-period/rule/update', data).then(res=>{
						this.saving = false
						this.get()
						successMsg(res.data)
					}).catch(err=>{
						this.saving = false
						handleError(err, '#add-form')
					})
				}
			},
			get(){
				if(!this.getting){
					if($.fn.DataTable.isDataTable('#tabel-rule')){
						$('#tabel-rule').DataTable().destroy()
					}
					this.getting = true
					myaxios('leave-period/rule?is_local='+this.is_local+'&year='+this.year).then(res=>{
						this.getting = false
						this.leavePeriodRule = res.data
					}).catch(err=>{
						this.getting = false
						handleError(err)
					})
					
				}
			},
			edit(id){
				this.isEdit = true
				let body = $("html, body");
				body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
					
				});
				myaxios('leave-period/'+id).then(res=>{
					this.lp = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			hapus(id){

			},
			getStatus(){
				myaxios('leave-period/rule-status').then(res=>{
					this.status = res.data.data
				}).catch(err=>{
					handleError(err)
				})
			},
			getThisYear(){
				this.is_local = 'all'
				this.year = this.this_year
				this.get()
			}
		},
		watch : {
			leavePeriodRule(val){
				setTimeout(()=>{
					$('#tabel-rule').DataTable()
				},1000)
			},
		},
		computed : {
		},
		created(){
			this.lp.rule_year = (new Date()).getFullYear()
			this.year = (new Date()).getFullYear()
			this.get()
			this.getStatus()
			this.years = []
			for(let y = 2018; y <= (thisYear()+1); y++){
				this.years.push(y)
			}
		},
		mounted(){
			// this.year = (new Date()).getFullYear()
		}
	}
</script>