<template>
	<div class="mac">
		<mac-header title="Detail Employee" icon="fa fa-address-book-o mif-ani-shuttle"></mac-header>
		<div class="mac-content">
			<div class="row">
				<div class="col-md-12">
					<router-link to="/employees">
						<batal-btn></batal-btn>
					</router-link>
					<router-link :to="'/employees/edit/'+employee.id">
						<edit-btn></edit-btn>
					</router-link>
					<hapus-btn @click.prevent.native="hapusEmployee(employee.id)"></hapus-btn>
					<a v-if="!employee.non_active" data-role="hint" data-hint-background="bg-black" data-hint-color="fg-white" data-hint-mode="2" data-hint="Non Activate" data-hint-position="top" @click.prevent="nonActivate(employee.id)" class="button fg-white bg-black cycle-button" href="#">
						<span class="mif-power"></span>
					</a>
					<print-btn text="Print Identity" :href="identityUrl+'/print/'+employee.id"></print-btn>
					<pdf-btn text="PDF Identity" :href="identityUrl+'/pdf/'+employee.id"></pdf-btn>
					<excel-btn text="Excel Identity" :href="identityUrl+'/excel/'+employee.id"></excel-btn>
				</div>
				<div class="col-sm-6 col-lg-5 mb-2">
					<my-card title="Biography">
						<table class="table table-bordered table-striped">
							<tbody>
								<tr>
									<td><strong>NIN</strong></td>
									<td>{{ employee.nin }}</td>
								</tr>
								<tr>
									<td><strong>Name</strong></td>
									<td>{{ employee.name }}</td>
								</tr>
								<tr>
									<td><strong>Gender</strong></td>
									<td>{{ employee.gender }}</td>
								</tr>
								<tr>
									<td><strong>Born In</strong></td>
									<td>{{ employee.born_in }}</td>
								</tr>
								<tr>
									<td><strong>Birthdate</strong></td>
									<td>{{ employee.bd }}</td>
								</tr>
								<tr>
									<td><strong>Handphone</strong></td>
									<td>{{ employee.handphone }}</td>
								</tr>
								<tr>
									<td><strong>Marital Status</strong></td>
									<td>{{ employee.marry }}</td>
								</tr>
								<tr>
									<td><strong>Present Address</strong></td>
									<td>{{ employee.present_address }}</td>
								</tr>
								<template v-if="employee.non_active">
									<tr class="fg-red">
										<td><strong>Non Active At</strong></td>
										<td>{{ employee.non_act_date }}</td>
									</tr>
									<tr class="fg-red">
										<td><strong>Reason</strong></td>
										<td>{{ employee.non_act }}</td>
									</tr>
								</template>
							</tbody>
						</table>
					</my-card>
				</div>
				<div class="col-sm-6 col-lg-5 mb-2">
					<my-card title="Placement">
						<table class="table table-bordered table-striped">
							<tbody>
								<tr>
									<td><strong>Department</strong></td>
									<td>{{ employee.dep ? employee.dep.name : '' }}</td>
								</tr>
								<tr>
									<td><strong>Job Title</strong></td>
									<td>{{ employee.pos ? employee.pos.name : '' }}</td>
								</tr>
								<tr>
									<td><strong>From</strong></td>
									<td>{{ employee.e_from }}</td>
								</tr>
								<tr>
									<td><strong>Type</strong></td>
									<td>{{ employee.e_type }}</td>
								</tr>
								<tr>
									<td><strong>Salary Type</strong></td>
									<td>{{ employee.salary_type }}</td>
								</tr>
								<tr>
									<td><strong>BRI Account</strong></td>
									<td>{{ employee.bri_account }}</td>
								</tr>
								<tr>
									<td><strong>Seguranca Social ID</strong></td>
									<td>{{ employee.seguranca_social }}</td>
								</tr>
								<tr>
									<td><strong>Joining At</strong></td>
									<td>{{ employee.join_date }}</td>
								</tr>
								<tr>
									<td><strong>Salary Group</strong></td>
									<td>{{ employee.sg ? employee.sg.name : '' }}</td>
								</tr>
							</tbody>
						</table>
					</my-card>
				</div>
				<div class="col-sm-6 col-lg-2 mb-2">
					<my-card title="Photo">
						<div class="image-container rounded bordered">
							<div class="frame"><img id="img-photo" :src="img"></div>
						</div>
					</my-card>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 mb-2">
					<my-card title="Family Background">
						<table class="table table-bordered table-striped">
							<tbody>
								<tr>
									<td><strong>Father</strong></td>
									<td>{{ employee.father }}</td>
								</tr>
								<tr>
									<td><strong>Mother</strong></td>
									<td>{{ employee.mother }}</td>
								</tr>
								<tr>
									<td><strong>Husband</strong></td>
									<td>{{ employee.husband }}</td>
								</tr>
								<tr>
									<td><strong>Wife</strong></td>
									<td>{{ employee.wife }}</td>
								</tr>
								<tr>
									<td><strong>Son</strong></td>
									<td>{{ employee.son }}</td>
								</tr>
								<tr>
									<td><strong>Wife</strong></td>
									<td>{{ employee.daughter }}</td>
								</tr>
							</tbody>
						</table>
					</my-card>
				</div>
				<div class="col-sm-6 mb-2">
					<my-card title="Educational History">
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<tbody>
									<tr>
										<td><strong>Elementary School</strong></td>
										<td>
											<template v-if="employee.elementary==''">
												-
											</template>
											<template else>
												{{ employee.elementary }}
											</template>
										</td>
										<td><strong>Graduation Year</strong></td>
										<td>
											<template v-if="employee.el_year==''">
												-
											</template>
											<template else>
												{{ employee.el_year }}
											</template>
										</td>
									</tr>
									<tr>
										<td><strong>Junior High School</strong></td>
										<td>
											<template v-if="employee.junior==''">
												-
											</template>
											<template else>
												{{ employee.junior }}
											</template>
										</td>
										<td><strong>Graduation Year</strong></td>
										<td>
											<template v-if="employee.jun_year==''">
												-
											</template>
											<template else>
												{{ employee.jun_year }}
											</template>
										</td>
									</tr>
									<tr>
										<td><strong>Senior High School</strong></td>
										<td>
											<template v-if="employee.senior==''">
												-
											</template>
											<template else>
												{{ employee.senior }}
											</template>
										</td>
										<td><strong>Graduation Year</strong></td>
										<td>
											<template v-if="employee.sen_year==''">
												-
											</template>
											<template else>
												{{ employee.sen_year }}
											</template>
										</td>
									</tr>
									<tr>
										<td><strong>University</strong></td>
										<td>
											<template v-if="employee.university==''">
												-
											</template>
											<template else>
												{{ employee.university }}
											</template>
										</td>
										<td><strong>Graduation Year</strong></td>
										<td>
											<template v-if="employee.u_year==''">
												-
											</template>
											<template else>
												{{ employee.u_year }}
											</template>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</my-card>
				</div>
				<div class="col-sm-6 mb-2">
					<my-card title="Important Files">
						<table class="table table-bordered table-striped">
							<tbody>
								<tr v-if="employee.certidao_baptismo">
									<td><strong>Certidao Baptismo</strong></td>
									<td><a target="_blank" :href="url.cb"> Download </a></td>
								</tr>
								<tr v-if="employee.cartao_rdtl">
									<td><strong>Cartao RDTL</strong></td>
									<td><a target="_blank" :href="url.cr"> Download </a></td>
								</tr>
								<tr v-if="employee.elektoral">
									<td><strong>Elektoral</strong></td>
									<td><a target="_blank" :href="url.e"> Download </a></td>
								</tr>
							</tbody>
						</table>
					</my-card>
				</div>
			</div>
		</div>
		<div class="mac-footer"></div>
	</div>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				id : this.$route.params.id,
				identityUrl : base_url('/employees/identity')
			}
		},
		computed : {
			...mapGetters([
				'employee'
				]),
			url(){
				return {
					cb : this.id ? base_url('/employees/'+this.id+'/certidao_baptismo/download') : '',
					cr : this.id ? base_url('/employees/'+this.id+'/cartao_rdtl/download') : '',
					e : this.id ? base_url('/employees/'+this.id+'/elektoral/download') : '',
				}
			},
			img() {
				return this.employee ? base_domain('/storage/' + this.employee.photo) : ''
			}
		},
		created(){
			this.$store.dispatch('getEmployee', this.$route.params.id)
			this.$store.state.employeeEditable = {
				status : true,
				id : this.$route.params.id
			}
		},
		mounted(){
			this.$store.dispatch('showView')
		}
	}
</script>