<template>
	<hris-mac :title="$store.getters.modul.mutation.title" :icon="$store.getters.modul.mutation.icon">
		<div class="row">
			<div class="col-md-12">
				<my-card title="Filter" class="mb-3">
					<b-row>
						<b-col md="4">
							<months-select v-model="month"></months-select>
						</b-col>
						<b-col md="4">
							<years-select v-model="year"></years-select>
						</b-col>
						<b-col md="12">
							<b-button @click="filter" size="sm" variant="primary">
								Filter
							</b-button>
							<b-button to="/mutations/new" size="sm" variant="primary">
								New
							</b-button>
							<b-button @click="excelURL" v-if="typeof mutations == 'object' && mutations.length > 0" size="sm" variant="success">
								<i class="fa fa-file-excel-o"></i> Excel
							</b-button>
						</b-col>
					</b-row>
				</my-card>
				<my-card v-if="typeof mutations == 'object' && mutations.length > 0" :title="'Mutation in '+year+'-'+month">
					<my-table>
						<thead>
							<tr>
								<th width="10px">#</th>
								<th>Mutation ID</th>
								<th>Employee</th>
								<th>New Job Title</th>
								<th>Old Job Title</th>
								<th>New Department</th>
								<th>Old Department</th>
								<th>Manager Who Rule</th>
								<th>Manager City</th>
								<th>Effect On</th>
								<th>Created At</th>
								<th width="80px">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(s, index) in mutations">
								<td>{{ ++index }}</td>
								<td>{{ s.mutation_id }}</td>
								<td>{{ '('+s.emp.nin+') '+s.emp.name }}</td>
								<td>{{ s.njb.name }}</td>
								<td>{{ s.ojb.name }}</td>
								<td>{{ s.ndep.name }}</td>
								<td>{{ s.odep.name }}</td>
								<td>{{ s.man.name }}</td>
								<td>{{ s.city }}</td>
								<td>{{ s.effect_on }}</td>
								<td>{{ s.created_at }}</td>
								<td>
									<b-button size="sm" @click="remove(s.id)" variant="danger"><i class="fa fa-trash"></i></b-button>
									<b-button size="sm" @click="letter(s.id)" variant="success">Letter</b-button>
									<b-button size="sm" @click="pdf(s.id)" variant="danger"><i class="fa fa-file-pdf-o"></i> Letter</b-button>
								</td>
							</tr>
						</tbody>
					</my-table>
				</my-card>
				<template v-else-if="mutations === 'processing'">
					<b-alert show variant="info">
						Processing
					</b-alert>
				</template>
				<template v-else>
					<b-alert show variant="danger">
						Data not available
					</b-alert>
				</template>
			</div>
		</div>
	</hris-mac>
</template>
<script>
import empSelect from './../employees/select'
export default {
	data(){
		return {
			mutations : [],
			month : '',
			year : getYear(),
		}
	},
	mounted(){
		this.$store.dispatch('showView')
	},
	methods : {
		filter(){
			if($('#month').val() == null){
				alert('select month')
				return
			}
			if($('#year').val() == null){
				alert('select year')
				return
			}
			this.month 			= $('#month').val()
			this.year 			= $('#year').val()
			this.mutations 	= 'processing'
			axios('mutations?month='+this.month+'&year='+this.year).then(res=>{
				this.mutations = res.data
			}).catch(err=>{
				this.mutations 	= []
			})
		},
		excelURL(){
			window.open(base_url('/mutations/excel?year='+this.year+'&month='+this.month))
		},
		remove(id){
			if(confirm('Are you sure?')){
				axios.post('mutations/'+id, {
					_method : 'delete'
				}).then(res=>{
					successMsg(res.data)
					this.filter()
				}).catch(err=>{
					handleError(err)
				})
			}
		},
		letter(id){
			window.open(base_url('/mutations/letter/'+id))
		},
		pdf(id){
			window.open(base_url('/mutations/letter/pdf/'+id))
		}
	},
	components : {
		empSelect
	},
	computed : {
		
	},
	watch : {
		
	},
	created(){
		let d = new Date()
		this.month = d.getMonth()+1
	}
}
</script>