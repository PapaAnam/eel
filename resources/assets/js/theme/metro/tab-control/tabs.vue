<template>
	<ul class="tabs">
		<li v-for="d in data">
			<a :href="'#'+d.id">
				{{ d.title }}
			</a>
		</li>
	</ul>
</template>
<script>
export default {
	props : ['data']
}
</script>