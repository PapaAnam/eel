<template>
	<my-card title="Edit">
		<form id="edit-form">
			<div class="row">
				<div class="col-md-12">
					<datepicker id="date_event" format="mm-dd" :value="event.month+'-'+event.date"></datepicker>
				</div>
				<div class="col-md-12">
					<input-text id="event" :value="event.event"></input-text>
				</div>
				<div class="col-md-12">
					<simpan-btn text="Update" @click.native.prevent="update"></simpan-btn>
					<batal-btn @click.native.prevent="$store.state.eventEditable={status:false,id:null}"></batal-btn>
				</div>
			</div>
		</form>
	</my-card>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
			saving : false
		}
	},
	computed : {
		...mapGetters([ 'event' ])
	},
	methods : {
		...mapActions([ 'getEvent' ]),
		update(){
			if(!this.saving){
				this.saving = true
				this.$store.dispatch('updateEvent', new FormData(document.getElementById('edit-form'))).then(()=>{
					this.saving = false
					window.calendar.fullCalendar('refetchEvents')
				})
			}
		},
		cancel(){
			this.$store.state.eventEditable = {
				status : false,
				id : null
			}
		}
	},
	watch : {
		eventEditable(){
			this.getEvent()
		}
	}
}
</script>