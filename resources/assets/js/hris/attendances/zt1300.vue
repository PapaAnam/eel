<template>
	<div class="row">
		<div class="col-md-12">
			<b-row>
				<b-col lg="2" md="4">
					<datepicker id="filter_date" label="Filter Date" v-model="filterDate"></datepicker>
				</b-col>
				<b-col lg="2" md="4" style="margin-top: 32px;">
					<b-button size="sm" class="mm" @click="filter" :disabled="filtering" variant="primary">{{ filtering ? 'Filtering' : 'Filter' }}</b-button>
					<b-button size="sm" v-if="attendances.length > 0 && attendances != 'processing'" @click="sync" :disabled="syncing" variant="primary">{{ syncing ? 'Syncing' : 'Synchronize' }}</b-button>
				</b-col>
			</b-row>
			<v-card :data="attendances">
				Showing attendance at {{ date }}
				<my-dt>
					<thead>
						<tr>
							<th width="10px">#</th>
							<th>FID</th>
							<th>NIN</th>
							<th>STAFF</th>
							<th>TIME</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(s, index) in attendances">
							<td>{{ ++index }}</td>
							<td>{{ s.Fid }}</td>
							<td>{{ s.staff ? s.staff.NIK : '' }}</td>
							<td>{{ s.Nama_Staff }}</td>
							<td>{{ s.Jam_Log }}</td>
						</tr>
					</tbody>
				</my-dt>
			</v-card>
		</div>
	</div>
</template>
<script>
	export default {
		data(){
			return {
				attendances : [],
				now : getDateNow(),
				date : '',
				syncing : false,
				filtering : false,
				filterDate : getDateNow(),
			}
		},
		created(){

		},
		methods : {
			filter(){
				this.date = this.filterDate
				this.attendances = 'processing'
				if(!this.filtering){
					this.filtering = true
					axios('attendances/zt1300-machine?date='+this.date).then(res=>{
						this.filtering = false
						this.attendances = res.data
					}).catch(err=>{
						this.filtering = false
					})
				}
			},
			sync(){
				if(!this.syncing){
					this.syncing = true
					axios.post('attendances/zt1300-machine/synchronize?date='+this.date).then(res=>{
						this.syncing = false
						successMsg(res.data)
					}).catch(err=>{
						this.syncing = false
					})
				}
			}
		},
		mounted(){
			this.$store.dispatch('showView')
		}
	}
</script>
<style>
@media screen and (min-width: 426px){
	.mm {
		margin-top: 15px;
	}
	.zm {
		margin-top: 23px;
	}
	.bm {
		margin-top: 5px;
	}
}
@media screen and (max-width: 425px){
	.mm {
		margin-left: 10px;
		margin-bottom: 20px;
		margin-top: -20px;
	}
	.zm {
		margin-left: 10px;
		margin-bottom: 20px;
		margin-top: -15px;
	}
	.bm {
		margin-left: 3px;
	}
}
</style>