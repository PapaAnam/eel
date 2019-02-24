<template>
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
					<!-- <th width="200px">Action</th> -->
				</tr>
			</thead>
			<tbody>
				<tr v-for="(s, index) in attendances">
					<td>{{ ++index }}</td>
					<td>{{ s.USERID }}</td>
					<td>{{ s.sn }}</td>
					<td>{{ s.CHECKTIME }}</td>
					<td>{{ s.CHECKTYPE }}</td>
					<td>{{ s.user_info.Name }}</td>
				</tr>
			</tbody>
		</my-dt>
	</v-card>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
			exportUrl : base_url('/attendances'),
			now : getDateNow(),
			attendances : [],
		}
	},
	computed : {
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
		filter(){
			axios('attendances/x100c?date='+$('#filter').val())
		}
	},
	watch : {
		attendances(){
			
		}
	},
	created(){
		
	}
}
</script>