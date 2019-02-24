<template>
	<my-card title="Data" class="mt-3">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="datatable">
				<thead>
					<tr>
						<th width="10px">#</th>
						<th>Each Date</th>
						<th>Event</th>
						<th width="100px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(e, index) in events">
						<td>{{ ++index }}</td>
						<td>{{ e.month_name+' '+e.date }}</td>
						<td>{{ e.event }}</td>
						<td>
							<edit-btn @click.prevent.native="edit(e.id)"></edit-btn>
							<hapus-btn @click.prevent.native="hapusEvent(e.id)"></hapus-btn>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</my-card>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
			exportUrl : base_url('/events')
		}
	},
	computed : {
		...mapGetters([ 'events' ])
	},
	methods : {
		...mapActions([ 'getEvents', 'getEvent' ]),
		edit(id){
			this.$store.state.eventEditable = {
				status : true,
				id
			}
			this.getEvent()
			$('.mac-content').scrollTop(0)
		},
		hapusEvent(id){
			if(confirm('Are you sure?')){
				axios.post('/special-day/'+id, {
					_method : 'DELETE'
				}).then(res=>{
					successMsg(res.data)
					this.getEvents()
				}).catch(res=>{
					handleError(err)
				})
			}
		}
	},
	watch : {
		events(){
			setDatatable()
			setTimeout(() => {
				$('.mac-preloader').fadeOut('slow')
			}, 1500)
		}
	},
	created(){
		this.getEvents()
	}
}
</script>