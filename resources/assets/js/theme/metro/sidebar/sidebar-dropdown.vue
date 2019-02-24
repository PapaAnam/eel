<template>
	<li>
		<a :class="['dropdown-toggle']" href="#"><span :class="icon"></span> {{ title }}</a>
		<ul class="d-menu" data-role="dropdown">
			<slot></slot>
		</ul>
	</li>
</template>
<script>
	export default {
		props : ['title', 'icon']
	}
</script>