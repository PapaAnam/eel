<template>
	<tabcontrol type-second>
		<tabs :data="myTabs"></tabs>
		<frames>
			<tab-content id="data">
				<grid>
					<row size="4">
						<cell>
							<my-dropdown :data="drivers" id="driver" label="Choose driver"></my-dropdown>
						</cell>
						<cell>
							<btn @click.prevent.native="gso">Show</btn>	
						</cell>
						<cell v-if="showBtn">
							<btn @click.prevent.native="proses">Proses</btn>	
						</cell>
					</row>
					<my-data>
						<div style="overflow:auto;" class="pb-20" v-if="!processing">
							<template v-if="salesOrder.length > 0">
								<my-dt>	
									<thead>
										<tr>
											<th width="10px">#</th>
											<th v-for="(d, key) in salesOrder[0]">
												{{ key }}
											</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(d, i) in salesOrder">
											<td><input v-model="check" type="checkbox" :value="d.KodeNota"></td>
											<td v-for="(dd, key) in d">
												{{ dd }}
											</td>
										</tr>
									</tbody>
								</my-dt>
							</template>
							<template v-else>
								<div class="bg-lightRed p-10 block-shadow-danger">
									No data available
								</div>
							</template>
						</div>
						<div v-else>
							<div class="bg-lighterBlue p-10 block-shadow-info">
								Getting data from server
							</div>
						</div>
					</my-data>
				</grid>
			</tab-content>
			<tab-content id="result">
				<grid>
					<row>
						<cell>
							<refresh-btn @click.prevent.native="getSoResult"></refresh-btn>
							<btn v-if="!ekspor" default @click.prevent.native="ekspor = true">
								Eskpor
							</btn>
							<btn v-if="ekspor" default @click.prevent.native="ekspor = false">
								Batal
							</btn>
						</cell>
					</row>
					<row v-if="ekspor" size="4">
						<cell>
							<inp type="date" icon="fa fa-calendar" id="export_date"></inp>
						</cell>
						<cell>
							<print-btn @click.prevent.native="ext('print')"></print-btn>
							<pdf-btn @click.prevent.native="ext('pdf')"></pdf-btn>
							<excel-btn @click.prevent.native="ext('excel')"></excel-btn>
						</cell>
					</row>
					<template v-if="reason">
						<row>
							<textar id="reason" v-model="reasonTxt" label="Alasan ditolak"></textar>
						</row>
						<row>
							<btn size="small" @click.native.prevent="setStatus(id, 0)" type="danger">Tolak</btn>
							<btn size="small" @click.native.prevent="reason = false" type="default">Batal</btn>
						</row>
					</template>
					<my-data :action="salesOrderResult">
						<thead>
							<tr>
								<th width="10px">#</th>
								<th v-for="(d, key) in salesOrderResult[0]" v-if="key != 'id'">
									{{ key }}
								</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(d, i) in salesOrderResult">
								<th width="10px">{{ ++i }}</th>
								<td v-for="(dd, key) in d" v-if="key != 'id'">
									<template v-if="key == 'Status'">
										<tag :type="getTag(dd)">{{ dd }}</tag>
									</template>
									<template v-else>
										{{ dd }}
									</template>
								</td>
								<td>
									<btn size="small" v-if="d.Status == 'Proses Kirim'" @click.native.prevent="setStatus(d.id, 'Ditolak')" type="danger">Tolak</btn>
									<btn size="small" v-if="d.Status == 'Proses Kirim'" @click.native.prevent="setStatus(d.id, 'Terkirim')" type="success">Terkirim</btn>
								</td>
							</tr>
						</tbody>
					</my-data>
				</grid>
			</tab-content>
			<tab-content id="in_process">
				<grid>
					<my-data :action="salesOrderInProcess">
						<thead>
							<tr>
								<th width="10px">#</th>
								<th v-for="(d, key) in salesOrderInProcess[0]" v-if="key != 'id'">
									{{ key }}
								</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(d, i) in salesOrderInProcess">
								<th width="10px">{{ ++i }}</th>
								<td v-for="(dd, key) in d" v-if="key != 'id'">
									<template v-if="key == 'Status'">
										<tag :type="getTag(dd)">{{ dd }}</tag>
									</template>
									<template v-else>
										{{ dd }}
									</template>
								</td>
							</tr>
						</tbody>
					</my-data>
				</grid>
			</tab-content>
		</frames>
	</tabcontrol>
</template>
<script>
import { mapGetters, mapActions, mapMutations } from 'vuex'
export default {
	data(){
		return {
			check : [],
			showBtn : false,
			driver : '',
			reason : false,
			reasonTxt : '',
			ekspor : false,
			id : '',
			myTabs : [
			{
				id : 'data',
				title : 'Data'
			},
			{
				id : 'result',
				title : 'Result'
			},
			{
				id : 'in_process',
				title : 'Dalam Proses'
			}
			]
		}
	},
	computed : {
		...mapGetters([
			'drivers', 'salesOrder', 'moduls', 'processing', 'salesOrderResult', 'salesOrderInProcess'
			])
	},
	methods : {
		...mapActions([
			'getDrivers', 'getSalesOrder', 'getSoResult'
			]),
		...mapMutations([
			'SET_MY_WINDOW'
			]),
		gso(){
			this.driver = $(this.$el).find('#driver').val().replace('/', '-').replace('/', '-')
			this.getSalesOrder(this.driver)
		},
		proses(){
			let fd = new FormData()
			for(let i of this.check)
				fd.append('KodeNota[]', i)
			fd.append('driver', this.driver)
			axios.post('sales-order/process', fd).then(res=>{
				this.gso()
				this.getSoResult()
				this.check = []
				successMsg(res.data)
			}).catch(err=>{

			})
		},
		getTag(status){
			if(status == 'Proses Kirim')
				return 'warning'
			return status == 'Terkirim' ? 'success' : 'alert'
		},
		setStatus(id, status){
			this.id = id
			if(status == 'Ditolak'){
				this.reason = true
				return
			}
			let fd = new FormData()
			fd.append('status', status)
			if(status == 0){
				fd.delete('status')
				fd.append('status', 'Ditolak')
				fd.append('AlasanDitolak', $('textarea#reason').val())
			}
			fd.append('_method', 'PUT')
			axios.post('sales-order/update-status/'+this.id, fd).then(res=>{
				this.getSoResult()
				this.reason = false
				successMsg(res.data)
			}).catch(err=>{
				handleError(err)
			})
		},
		ext(command){
			let tgl = $(this.$el).find('#export_date').val()
			if(tgl == ''){
				alert('tanggal wajib diisi')
				return
			}
			if(tgl.substr(0,4) == '' || tgl.substr(0,4).includes('y') || tgl.substr(5,2) == '' || tgl.substr(5,2).includes('m') || tgl.substr(8,2) == '' || tgl.substr(8,2).includes('d')){
				alert('tanggal tidak valid')
				return
			}
			window.open(base_url('/sales-order/'+command+'/'+tgl))
		}
	},
	created(){
		this.SET_MY_WINDOW('salesOrder')
		this.getDrivers()
		this.getSoResult()
	},
	mounted(){
		
	},
	watch : {
		check(){
			if(this.check.length > 0)
				this.showBtn = true
			else
				this.showBtn = false
		}
	}
}
</script>