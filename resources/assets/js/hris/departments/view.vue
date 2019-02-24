<template>
	<b-card header="Data" header-bg-variant="primary" header-text-variant="white">
		<div class="row">
			<div class="col-md-12">
				<export-btn :url="exportUrl"></export-btn>
			</div>
			<div class="col-md-12">
				<table class="table bordered border striped" id="datatable">
					<thead>
						<tr>
							<th width="10px">#</th>
							<th>Name</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(d, index) in departments">
							<td>{{ ++index }}</td>
							<td>
								{{ d.name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<a @click.prevent="baru(d.id, d.name)" href="#"><i class="fa fa-plus"></i></a>
								<a @click.prevent="edit(d.id)" href="#"><i class="fa fa-pencil"></i></a>
								<a @click.prevent="hapusDept(d.id)" href="#"><i class="fa fa-trash"></i></a>
								<ul>
									<li v-for="dep in d.depts">
										{{ dep.name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a @click.prevent="baru(dep.id, dep.name)" href="#"><i class="fa fa-plus"></i></a>
										<a @click.prevent="edit(dep.id)" href="#"><i class="fa fa-pencil"></i></a>
										<a @click.prevent="hapusDept(dep.id)" href="#"><i class="fa fa-trash"></i></a>
										<ul>
											<li v-for="depp in dep.depts">
												{{ depp.name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<a @click.prevent="baru(depp.id, depp.name)" href="#"><i class="fa fa-plus"></i></a>
												<a @click.prevent="edit(depp.id)" href="#"><i class="fa fa-pencil"></i></a>
												<a @click.prevent="hapusDept(depp.id)" href="#"><i class="fa fa-trash"></i></a>
												<ul>
													<li v-for="deppp in depp.depts">
														{{ deppp.name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														<a @click.prevent="baru(deppp.id, deppp.name)" href="#"><i class="fa fa-plus"></i></a>
														<a @click.prevent="edit(deppp.id)" href="#"><i class="fa fa-pencil"></i></a>
														<a @click.prevent="hapusDept(deppp.id)" href="#"><i class="fa fa-trash"></i></a>
														<ul>
															<li v-for="depppp in deppp.depts">
																{{ deppp.name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																<a @click.prevent="baru(depppp.id, depppp.name)" href="#"><i class="fa fa-plus"></i></a>
																<a @click.prevent="edit(depppp.id)" href="#"><i class="fa fa-pencil"></i></a>
																<a @click.prevent="hapusDept(depppp.id)" href="#"><i class="fa fa-trash"></i></a>
																<ul>
																	<li v-for="deppppp in depppp.depts">
																		{{ depppp.name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		<a @click.prevent="baru(deppppp.id, deppppp.name)" href="#"><i class="fa fa-plus"></i></a>
																		<a @click.prevent="edit(deppppp.id)" href="#"><i class="fa fa-pencil"></i></a>
																		<a @click.prevent="hapusDept(deppppp.id)" href="#"><i class="fa fa-trash"></i></a>
																	</li>
																</ul>
															</li>
														</ul>
													</li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</b-card>
</div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
			dt : '',
			exportUrl : base_url('/departments')
		}
	},
	computed : {
		...mapGetters([
			'departments',
			'deptDt'
			])
	},
	methods : {
		...mapActions([
			'getDepartments',
			'setDt',
			'hapusDept'
			]),
		redraw(){
			this.dt.draw(false)
		},
		edit(id){
			if($(window).width() <= 768){
				$('.mac-content').scrollTop(99999)
			}
			this.$store.commit('SET_DEPARTMENT_EDITABLE', {
				status : true,
				id
			})
		},
		baru(id, name){
			if($(window).width() <= 768){
				$('.mac-content').scrollTop(99999)
			}
			this.$store.commit('SET_DEPARTMENT_BARU', {
				id, name
			})
		}
	},
	watch : {
		departments(){
			setDatatable()
			setTimeout(() => {
				$('.mac-preloader').fadeOut('slow')
			}, 1500)
		}
	},
	created(){
		this.getDepartments()
	},
	mounted(){
		$('.mac-preloader').fadeIn('slow');
	}
}
</script>