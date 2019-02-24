<template>
	<div class="row">
		<div class="col-md-6">
			<export-btn :url="exportUrl"></export-btn>
		</div>
		<div class="col-md-4">
			<input-date :value="now" label="Filter by date" id="filter"></input-date>
			<btn-primary @click.prevent.native="filter" text="Filter"></btn-primary>
		</div>
		<div class="col-md-12" v-if="!gettingFromServer">
			Showing attendance at {{ date }}
			<div class="table-responsive">
				<table class="table bordered border striped" id="datatable">
					<thead>
						<tr>
							<th width="10px">#</th>
							<th>Employee</th>
							<th>Date</th>
							<th>Status</th>
							<th>Enter At</th>
							<th>Break</th>
							<th>End Break</th>
							<th>Out At</th>
							<!-- <th>Work Total</th>
							<th>Over Time</th> -->
							<th width="200px">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(s, index) in attendances">
							<td>{{ ++index }}</td>
							<td>{{ s.emp.nin+' - '+s.emp.name }}</td>
							<td v-if="getDay(s.created_at) === 0" style="color: red;">{{ s.created_at }}</td>
							<td v-else>{{ s.created_at }}</td>
							<td>{{ s.stat }}</td>
							<td>{{ s.enter }}</td>
							<td>{{ s.break }}</td>
							<td>{{ s.end_break }}</td>
							<td>{{ s.out }}</td>
							<!-- <td>{{ s.work_total }}</td>
							<td>{{ s.over_time }}</td> -->
							<td>
								<router-link @click.prevent.native="edit(s.id)" :to="'/attendances/edit/' + s.id">
									<edit-btn></edit-btn>
								</router-link>
								<hapus-btn @click.prevent.native="hapusAttendance(s.id)"></hapus-btn>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-12" v-else>
			Getting data from server
		</div>
	</div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
			exportUrl : base_url('/attendances'),
			now : getDateNow(),
			gettingFromServer : false,
		}
	},
	computed : {
		...mapGetters([
			'attendances'
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
			this.date = $('#filter').val()
			$('#datatable').DataTable().destroy()
			this.getAttendances(this.date).then(()=>{
				this.gettingFromServer = false
			})
		},
		getDay(day){
			let d = new Date(day);
			// let weekday = new Array(7);
			// weekday[0] = "Sunday";
			// weekday[1] = "Monday";
			// weekday[2] = "Tuesday";
			// weekday[3] = "Wednesday";
			// weekday[4] = "Thursday";
			// weekday[5] = "Friday";
			// weekday[6] = "Saturday";
			// var n = weekday[d.getDay()];
			return d.getDay()
		}
	},
	watch : {
		attendances(){
			$('#datatable').DataTable().destroy()
			setDatatable()
			fadeOutPreloader()
		}
	},
	created(){
		this.getAttendances() 
		this.$store.state.attendanceEditable = {
			status : false,
			id : null
		}
	}
}
</script>