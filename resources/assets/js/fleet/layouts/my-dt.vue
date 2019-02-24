<template>
	<div>
		<table class="table striped hovered cell-hovered border bordered">
			<slot></slot>
		</table>
		<div class="ac" style="display: none;"></div>
	</div>
</template>
<script>
export default {
	mounted(){
		var myTable = $(this.$el).find('table').DataTable({
			dom: 'Bfrtip',
			stateSave: true,
			buttons: [
			{
				"extend": "colvis",
				"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
				"className": "button",
				columns: ':not(:first)',
			},
			]
		})
		let vm = this
		var defaultColvisAction = myTable.button(0).action();
		myTable.button(0).action(function (e, dt, button, config) {
			defaultColvisAction(e, dt, button, config);
			if($('.dt-button-collection > .colvis-container').length == 0) {
				$('.dt-button-collection')
				.wrapInner('<div class="colvis-container" />')
				$('.dt-button-collection > .colvis-container')
				.wrapInner('<div class="row" />')
				$('.dt-button-collection > .colvis-container > .row')
				.wrapInner('<div class="grid" />')
				.find('a').wrap('<div class="cell" />').attr('href', '#').addClass('full-size button fg-white')
			}
			$('.dt-button-collection').css({
				maxHeight : $('.window').height()-50,
				overflow  : 'auto',
				width : 'auto',
				marginTop : 0
			}).appendTo($(vm.$el).find('.ac'))
			$(vm.$el).find('.ac').fadeIn()
		});
	}
}
</script>
<style>
.ac {
	position: fixed;
    z-index: 99999;
    top: 0;
    left: 0;
    max-width: 100%;
    background-color: #ffffff;
    padding: 5px;
}
.buttons-columnVisibility.active {
	color: #ffffff;
	background-color: #4390df;
}
.buttons-columnVisibility {
	color: #ffffff;
	background-color: #ce352c;
}
</style>