<template>
	<div>
		<div class="mac">
			<mac-header :title="$store.getters.modul.salaryRule.title" :icon="$store.getters.modul.salaryRule.icon"></mac-header>
			<div class="mac-content">
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-4 mb-2">
						<my-card title="Select employee to view">
							<employees-select id="employee"></employees-select>
							<btn-primary @click.native.prevent="filter" :processing="filtering" :text="filtering ? 'Searching' : 'View'"></btn-primary>
							<b-button v-if="!isNew2" size="sm" variant="danger" @click="setNew(2)">New Salary</b-button>
							<btn-primary class="float-right" v-if="!isNew" @click.native.prevent="setNew(1)" text="New Component Salary"></btn-primary>
							<batal-btn class="float-right" v-if="isNew || isNew2" @click.prevent.native="cancel"></batal-btn>
						</my-card>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-4 mb-2">
						<my-card title="View Salary Rule By Out At Rule">
							<my-select id="out_at_rule_filter" label="Choose Out At Rule">
								<option value="all">All</option>
								<option v-for="o in outAtRule" :value="o">{{ o }}</option>
							</my-select>
							<btn-primary @click.native.prevent="filterByType" :processing="filtering2" :text="filtering2 ? 'Searching' : 'View'"></btn-primary>
							<a @click.prevent="excelGroup" class="btn btn-sm btn-success fg-white">
								<span class="mif-file-excel"></span> Excel
							</a>
						</my-card>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-4 mb-2">
						<my-card title="View Salary Rule By Salary Group">
							<salary-group :appends="{value:'all',text:'All'}" v-model="group"></salary-group>
							<btn-primary @click.native.prevent="filterByGroup" :processing="filtering3" :text="filtering3 ? 'Searching' : 'View'"></btn-primary>
						</my-card>
					</div>
					<div v-if="isNew" class="col-md-12">
						<niu @refresh="filter" :seguranca-manual="!is_seguranca_auto"></niu>
					</div>
					<div v-if="isNew2" class="col-md-12">
						<niu2 @refresh="filter"></niu2>
					</div>
					<div class="col-md-12">
						<viu :seguranca-manual="!is_seguranca_auto" :processing="filtering || filtering2 || filtering3" :data="data" :title="title" @edit="setNew"></viu>
					</div>
				</div>
			</div>
			<div class="mac-footer"></div>
		</div>
	</div>
</template>
<script>
	import niu from './new'
	import niu2 from './new2'
	import viu from './view'
	import salaryGroup from './../salary-group/select'
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				is_seguranca_auto : false,
				isNew : false,
				isNew2 : false,
				data : [],
				title : 'showing salary rule for',
				filtering : false,
				filtering2 : false,
				filtering3 : false,
				outAtRule : ['17:00:00','17:30:00','18:00:00','18:30:00','19:00:00','19:30:00','20:00:00','20:30:00','21:00:00','21:30:00','22:00:00','22:30:00','23:00:00','23:30:00','23:59:00',
				],
				group : null,
			}
		},
		mounted(){
			this.$store.dispatch('showView')
			fadeOutPreloader()
			$('#employee').on('change', () => {
				this.getSalaryRule($('#employee').val())
			})
		},
		computed : {
			...mapGetters([
				'bgTiles',
				'icons'
				])
		},
		methods : {
			...mapActions([
				'getSalaryRule'
				]),
			filter(){
				this.cancel()
				this.filtering = true
				myaxios('salary-rules?employee='+$('#employee').val()+'&array=true').then(res=>{
					this.filtering = false
					this.data = res.data
					let a = document.getElementById('employee')
					let name = a.selectedOptions[0].text
					this.title = 'showing salary rule for '+name
				}).catch(err=>{
					this.filtering = false
					handleError(err)
				})
			},
			filterByType(){
				if($('#out_at_rule_filter').val() == null){
					alert('choose out at rule first')
					return
				}
				this.filtering2 = true
				myaxios('salary-rules?out_at_rule='+$('#out_at_rule_filter').val()).then(res=>{
					this.filtering2 = false
					this.data = res.data
					this.title = 'showing salary rule for '+$('#out_at_rule_filter').val()
				}).catch(err=>{
					this.filtering2 = false
					handleError(err)
				})
			},
			filterByGroup(){
				if(this.group){
					this.filtering3 = true
					myaxios('salary-rules?group='+this.group).then(res=>{
						this.filtering3 = false
						this.data = res.data
						this.title = 'showing salary rule for '+(res.data.length > 0 ? res.data[0].salary_group.name : '')
					}).catch(err=>{
						this.filtering3 = false
						handleError(err)
					})
				}else{	
					alert('choose salary group first')
				}
			},
			baru(){
				this.currentView = 'salary-rules-new'
				this.getSalaryRule($('#employee').val())
			},
			setNew(tipe){
				if(tipe == 1){
					this.isNew2 = false
					this.isNew = true
				}else{
					this.isNew2 = true
					this.isNew = false
				}
			},
			cancel(){
				this.isNew2 = false
				this.isNew = false
			},
			excelGroup(){
				window.open(base_url('/salary-rules/excel?out_at_rule='+$('#out_at_rule_filter').val()))
			}
		},
		created(){
			axios('setting/seguranca').then(res=>{
				this.is_seguranca_auto = res.data == 1
			})
		},
		components : {
			niu, viu, niu2, salaryGroup
		}
	}
</script>