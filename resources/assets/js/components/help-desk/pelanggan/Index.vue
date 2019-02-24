<template>
	<div>
		<div class="menu-header">
			<div class="menu-title">
				<h1>
					<router-link to="/">
						<span class="mif-arrow-left fg-white"></span>
					</router-link>
					Pelanggan
				</h1>
			</div>
		</div>
		<div class="menu-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 float-md-right">
						<form class="form-inline float-md-right">
							<button class="btn btn-primary btn-sm" @click.prevent="allData">View All</button>
							<div class="form-group">
								<input type="search" v-model="keyword" @keydown.enter.prevent="search" id="pencarian" class="form-control form-control-sm" placeholder="Search">
							</div>
							<button type="submit" class="btn btn-primary btn-sm" @click.prevent="search"><i class="fa fa-search"></i></button>
						</form>
						<br>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered fg-white">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Perusahaan</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(p, index) in pelanggan.data">
									<td>{{ u(index) }}</td>
									<td>{{ p.NickNameOwner }}</td>
									<td>{{ p.Perusahaan }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<ul class="pagination pagination-sm">
							<li :class="['page-item', pelanggan.current_page == 1 ? 'disabled' : '']">
								<a class="page-link" @click.prevent="to(pelanggan.first_page_url)" href="#">First</a>
							</li>
							<li v-if="pelanggan.prev_page_url != null" class="page-item">
								<a @click.prevent="previous()" class="page-link" href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>
							<li v-if="url.length > 0" v-for="i in url" :class="['page-item', i.active ? 'active' : '']">
								<a @click.prevent="to(i.link)" class="page-link" href="#">
									{{ i.num }}
								</a>
							</li>
							<li v-if="pelanggan.next_page_url != null" class="page-item">
								<a @click.prevent="next()" class="page-link" href="#" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
							<li :class="['page-item', pelanggan.current_page == pelanggan.last_page ? 'disabled' : '']">
								<a class="page-link" @click.prevent="to(pelanggan.last_page_url)" href="#">Last</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data(){
		return {
			pelanggan : [],
			keyword : ''
		}
	},
	computed : {
		url : function(){
			let url = []
			let awal = this.pelanggan.current_page - 3
			if(awal <= 0)
				awal = 1
			let akhir = this.pelanggan.current_page + 3
			if(akhir > this.pelanggan.last_page)
				akhir = this.pelanggan.last_page
			for(let i = awal; i <= akhir; i++){
				url.push({
					link : base_url('/help-desk/pelanggan/data?page='+i),
					num : i,
					active : this.pelanggan.current_page == i
				})
			}
			return url
		}
	},
	methods : {
		u(i){
			return Number(i)+1
		},
		next(){
			this.fetchData(this.pelanggan.next_page_url)
		},
		to(url){
			this.fetchData(url)
		},
		previous(){
			this.fetchData(this.pelanggan.prev_page_url)
		},
		fetchData(url){
			axios(url)
			.then(res=>{
				this.pelanggan = res.data 
			})
		},
		search(){
			if(this.keyword.trim() != ""){
				this.fetchData('help-desk/pelanggan/data/'+this.keyword)
			}
		},
		allData(){
			this.fetchData('help-desk/pelanggan/data')
		}
	},
	created(){
		this.allData()
		$('body').css('overflowY', 'auto')
	},
	mounted(){
		hidePreloader()
	}
}
</script>