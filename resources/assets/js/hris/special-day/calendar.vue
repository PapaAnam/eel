<template>
	<my-card title="Calendar">
		<h6 id="idi" style="display:none;">Getting data from server</h6>
		<div id="calendar"></div>
	</my-card>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
	data() {
		return {
			cal : ''
		}
	},
	computed : {
		...mapGetters([ 'events' ])
	},
	watch : {
		events(){
			// this.cal.fullCalendar('refetchEvents')
		}
	},
	mounted() {
		window.calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			buttonText: {
				today: 'today',
				month: 'month',
				week: 'week',
				day: 'day'
			},
			events : {
				url: base_url('/special-day/event-list'),
				error : function(res){
					errorMsg(res.message)
				}
			},
			loading: function(bool) {
				$('#idi').toggle(bool)
			}
		})
		setTimeout(function(){
			$('#calendar').fullCalendar('today');
		}, 2000);
	}
}
</script>