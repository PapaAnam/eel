<template>
    <ul :class="[TYPE, THEME]">
        <slot></slot>
    </ul>
</template>
<script>
    export default {
        props : ['type', 'theme'],
        computed : {
            TYPE(){
                return this.type === undefined ? 'sidebar' : 'sidebar'+this.type
            },
            THEME(){
                return this.theme === undefined ? '' : this.theme
            },
        }
    }
</script>