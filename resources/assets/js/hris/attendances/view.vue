<template>
	<div class="row">
		<div class="col-lg-2">
			<a data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom" data-hint="Print" data-hint-background="bg-steel" @click.prevent="toPrint" class="button bg-steel fg-white cycle-button">
				<span class="mif-printer"></span>
			</a>
			<a @click.prevent="toExcel" data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom" data-hint="Excel" data-hint-background="bg-green" class="button success fg-white cycle-button">
				<span class="mif-file-excel"></span>
			</a>
		</div>
		<div class="col-lg-2 col-md-2">
			<datepicker id="filter_date" label="Filter Date" v-model="filterDate"></datepicker>
		</div>
		<div class="col-md-3 lurus">
			<b-button size="sm" class="bm" variant="primary" @click="filter" :disabled="gettingFromServer">{{ gettingFromServer ? 'Filtering' : 'Filter' }}</b-button>
		</div>
		<div class="col-md-12">
			<v @refresh="filter" :msg="'Showing attendance at '+date" :attendances="attendances"></v>
		</div>
	</div>
</template>
<script>
	import v from './v.vue'
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				exportUrl : base_url('/attendances'),
				now : getDateNow(),
				gettingFromServer : false,
				attendances : [],
				filterDate : getDateNow(),
			}
		},
		computed : {
			...mapGetters([
				]),
			date : {
				get(){
					return this.now
				},
				set(val){
					this.now = val
				}
			}
		},
		methods : {
			...mapActions([
				'getAttendances', 'hapusAttendance'
				]),
			edit(id){
				this.$store.state.attendanceEditable = {
					status : true,
					id
				}
			},
			detail(id){
				this.$store.state.attendanceEditable = {
					status : true,
					id
				}
			},
			filter(){
				this.gettingFromServer = true
				this.date = this.filterDate
				this.load()
			},
			load(){
				this.attendances = 'processing'
				axios('attendances/data/filter-date/'+this.date).then(res=>{
					this.attendances = res.data
					this.gettingFromServer = false
				}).catch(err=>{
					this.attendances = []
					this.gettingFromServer = false
				})
			},
			toExcel(){
				window.open(base_url('/attendances/excel?date='+this.date))
			},
			toPrint(){
				window.open(base_url('/attendances/print?date='+this.date))	
			}
		},
		watch : {

		},
		created(){
			let d = new Date()
			this.date = d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate()
			this.$store.state.attendanceEditable = {
				status : false,
				id : null
			}
		},
		components : {
			v 
		}
	}
</script>
<style>
@media screen and (min-width: 768px) {
	.lurus {
		margin-top: 31px;
	}
}
@media screen and (max-width: 425px) {
	.lurus {
		padding: 10px;
		margin-left: 12px;
	}
}
</style>