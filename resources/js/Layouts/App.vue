<template>
    <div>
        <NavBar />
        <slot name="content" />
    </div>
</template>
    
<script>

    import NavBar from '@/Components/myComp/NavBar.vue';
    
    export default {
        components: {
            NavBar
        },
    };
</script>

<style lang="css" scoped>

</style>