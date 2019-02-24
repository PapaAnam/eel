<template>
	<li>
		<a href="" :class="['dropdown-toggle', titleClass]">{{ title }}</a>
		<ul class="d-menu" data-role="dropdown">
			<slot></slot>
		</ul>
	</li>
</template>
<script>
export default {
	props : ['title', 'titleClass'],
}
</script>