<template>
	<my-card title="New" class="mb-2">
		<form id="add-form">
			<div class="row">
				<div class="col-md-12">
					<datepicker label="Date Event" id="date_event" format="mm-dd"></datepicker>
				</div>
				<div class="col-md-12">
					<input-text id="event"></input-text>
				</div>
				<div class="col-md-12">
					<simpan-btn @click.native.prevent="simpan"></simpan-btn>
				</div>
			</div>
		</form>
	</my-card>
</template>

<script>
import { mapActions } from 'vuex'
export default{
	data(){
		return {
			saving : false	
		}
	},
	methods : {
		...mapActions([ 'saveEvent' ]),
		simpan(){
			if(!this.saving){
				this.saving = true
				this.saveEvent($('#add-form').serialize()).then(()=>{
					this.saving = false
					window.calendar.fullCalendar('refetchEvents')
				})
			}
		}
	},
	created(){
	}
}
</script>