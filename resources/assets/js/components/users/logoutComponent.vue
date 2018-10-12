
<template>
    
</template>

<script>
export default {
    data () {
        return {

        }
    },
    mounted () {
        this.$session.destroy();
        // console.log(this.$session.get('accessToken'), 'sdfdfsdfsdf');
        this.$router.push('/');
    }
}
</script>