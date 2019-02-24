<template>
	<div class="row">
		<div class="col-md-12">
			<my-select id="department[]" v-model="depId" label="Department">
				<option v-for="d in depts" :value="d.id">{{ d.name }}</option>
			</my-select>
		</div>
		<div class="col-md-12" v-if="bawahnya_ada">
			<dep-sel :depts="subDepts"></dep-sel>
		</div>
	</div>
</template>
<script>
export default {
	data(){
		return {
			eek : '',
			bawahnya_ada : false,
			subDepts : [],
			depId : '',
		}
	},
	props : ['depts'],
	watch : {
		depId(val){
			if(val){
				let dep = _.find(this.depts, (item, key)=>{
					return item.id == val
				})	
				if(dep.depts.length > 0){
					this.bawahnya_ada = true
					this.subDepts = dep.depts
				}else{
					this.bawahnya_ada = false
					this.subDepts = []
				}
			}
		}
	},
	computed : {

	},
	methods : {
		
	},
	created(){
		
	},
	mounted(){
	}
}
</script>