<template>
  <hris-mac :title="$store.getters.modul.mutation.title" :icon="$store.getters.modul.mutation.icon">
    <router-link to="/mutations">
      <i class="fa fa-arrow-left"></i> Back
    </router-link>
    <form role="form" method="post" id="add-form">
      <div class="row">
        <div class="col-md-4">
          <my-card ty title="Employee To Mutation">
            <div class="row">
              <div class="col-md-12">
                <employees-select @change="showDep"></employees-select>
              </div>
              <div class="col-md-12">
                <b-button size="sm" variant="primary" @click="show">Check</b-button>
              </div>
              <div class="col-md-12">
                <my-inp v-model="dep" type="text" label="Department Now" :readonly="true"></my-inp>
              </div>
              <div class="col-md-12">
                <my-inp v-model="job" type="text" label="Job Title Now" :readonly="true"></my-inp>
              </div>
              <div class="col-md-12">
                <employees-select label="The Leader Who Rule" id="manager" @change="showDep"></employees-select>
              </div>
              <div class="col-md-12">
                <my-inp id="city" type="text" label="Leader City"></my-inp>
              </div>
            </div>
          </my-card>
        </div>
        <div class="col-md-4">
          <my-card title="Mutation To">
            <div class="row">
              <div class="col-sm-12">
                <dep-sel :depts="$store.getters.departments"></dep-sel>
              </div>
              <div class="col-sm-12">
                <pos-sel></pos-sel>
              </div>
            </div>
          </my-card>
        </div>
        <div class="col-md-4">
          <my-card title="Mutation Data">
            <div class="row">
              <div class="col-md-12">
                <my-inp id="mutation_id" label="Mutation ID" :readonly="true" v-model="mutation_id"></my-inp>
              </div>
              <div class="col-md-12">
                <b-button variant="primary" size="sm" @click="genMutationId">Generate Mutation ID</b-button>
              </div>
              <div class="col-md-12 pt-2">
                <my-textarea label="Reason" id="reason"></my-textarea>
              </div>
              <div class="col-md-12">
                <datepicker id="effect_on" label="Effect On"></datepicker>
              </div>
            </div>
          </my-card>
        </div>
        <div class="col-md-12">
          <br>
          <simpan-btn @click.native.prevent="save" :saving="saving"></simpan-btn>
        </div>
      </div>
    </form>
  </hris-mac>
</template>
<script>
import depSelect from './../departments/select.vue'
export default {
  data(){
    return {
      dep : '',
      job : '',
      depts : [],
      saving : false,
      mutation_id : ''
    }
  },
  props : [],
  watch : {

  },
  computed : {

  },
  methods : {
    showDep(empId){
      let emp = _.find(this.$store.state.employees, (item, key)=>{
        return item.id == empId
      })
      this.dep = emp.dep.name
      this.job = emp.pos.name
    },
    show(){
      this.showDep($(this.$el).find('select#employee').val())
    },
    save(){
      if(!this.saving){
        resetAllError()
        this.saving = true
        axios.post('mutations/store', new FormData(document.getElementById('add-form'))).then(res=>{
          this.saving = false
          successMsg(res.data)
        }).catch(err=>{
          this.saving = false
          handleError(err, '#add-form')
        })
      }
    },
    genMutationId(){
      let d = new Date()
      this.mutation_id = d.getFullYear()+''+d.getMonth()+''+d.getDay()+''+d.getHours()+''+d.getMinutes()+''+d.getSeconds()+''+d.getMilliseconds()
    }
  },
  created(){
    this.$store.dispatch('getDepartments')
  },
  mounted(){
    this.genMutationId()
    this.$store.dispatch('showView')
  },
  components : {
    depSelect
  }
}
</script>