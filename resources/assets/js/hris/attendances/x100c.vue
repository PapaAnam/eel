<template>
	<div class="row">
		<div class="col-md-12">
			<b-row>
				<b-col md="2">
					<datepicker id="filter_date" label="Filter Date" v-model="filterDate"></datepicker>
				</b-col>
				<b-col md="2" class="mt-4">
					<btn-primary class="zm" @click.prevent.native="filter" :text="filtering ? 'Filtering' : 'Filter'"></btn-primary>
					<btn-primary v-if="attendances.length > 0 && attendances != 'processing'" @click.prevent.native="sync" :text="syncing ? 'Syncing' : 'Synchronize'"></btn-primary>
				</b-col>
			</b-row>
			<v-card :data="attendances">
				Showing attendance at {{ date }}
				<my-dt>
					<thead>
						<tr>
							<th width="10px">#</th>
							<th>USER ID</th>
							<th>SN</th>
							<th>CHECKTIME</th>
							<th>CHECKTYPE</th>
							<th>EMPLOYEE</th>
							<th>BADGENUMBER</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(s, index) in attendances">
							<td>{{ ++index }}</td>
							<td>{{ s.USERID }}</td>
							<td>{{ s.sn }}</td>
							<td>{{ s.CHECKTIME }}</td>
							<td>{{ s.CHECKTYPE }}</td>
							<td>{{ s.user_info ? s.user_info.NAME : '' }}</td>
							<td>{{ s.user_info ? s.user_info.BADGENUMBER : '' }}</td>
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
					axios('attendances/x100c-machine?date='+this.date).then(res=>{
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
					axios.post('attendances/x100c-machine/synchronize?date='+this.date).then(res=>{
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