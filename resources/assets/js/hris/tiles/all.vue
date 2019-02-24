<template>
	<div class="menu-body"> 
		<div class="tile-area">
			<div class="single-tile-group"> 
				<departments-tile class="bunder" @click.native="setBg('department')"></departments-tile>
				<jobs-tile class="bunder" @click.native="setBg('job')"></jobs-tile>
				<employees-tile class="bunder" @click.native="setBg('employee')"></employees-tile>
			</div>
			<div class="single-tile-group"> 
				<attendances-tile class="bunder" @click.native="setBg('attendance')"></attendances-tile>
				<mt :to="['always-presence','always_presence']" :setting="$store.getters.modul.alwaysPresence"></mt>
				<salary-rules-tile class="bunder" @click.native="setBg('salary-rule')"></salary-rules-tile>
				<div @click="to('salary-group', 'salary_group')" :class="['tile bunder', $store.getters.bgTiles.salaryGroup]" data-role="tile">
					<div class="tile-content iconic">
						<i :class="['icon', $store.getters.modul.salaryGroup.icon]"></i>
					</div>
					<span class="tile-label">{{ $store.getters.modul.salaryGroup.title }}</span>
				</div>
				<payroll-tile class="bunder" @click.native="setBg('payroll')"></payroll-tile>
			</div>
			<div class="single-tile-group"> 
				<special-day-tile class="bunder"></special-day-tile>
				<accounts-tile class="bunder" @click.native="setBg('account')"></accounts-tile>
				<official-travel-tile class="bunder"></official-travel-tile>
				<mt :to="['cash-withdrawal','cash_withdrawal']" :setting="$store.getters.modul.cashWithdrawal"></mt>
				<leave-period-tile class="bunder"></leave-period-tile>
				<mutations-tile class="bunder" @click.native="setBg('mutation')"></mutations-tile>
			</div>
				
		</div>
	</div>
</template>
<script>
	import mt from './my-tile'
	export default {
		methods : {
			c(){
				comingSoon()
			},
			setBg(modul){
				let bg = $('[data-tile="'+modul+'"]').css('backgroundColor')
				setTimeout(()=>{
					$('.mac-header, .mac-footer').css({
						backgroundColor : bg,
					})
					$('.mac-content').css({
						borderColor : bg,
					})
				}, 1000)
			},
			to(router, authority){
				if(this.$store.getters.activeUser.auth[authority] == 1){
					this.$router.push(router)
				}else{
					notAuthorizedMsg()
				}
			}
		},
		created() {
			this.$store.dispatch('setBgTiles')
		},
		mounted(){

		},
		components : {
			mt
		}
	}
</script>
<style>
.bunder {
	border-radius: 20px;
}
</style>