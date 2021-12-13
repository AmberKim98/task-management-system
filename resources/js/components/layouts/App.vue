<template>
    <div>
        <b-container class="my-4">
            <router-view></router-view>    
        </b-container>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('App.vue mounted');
    }
}
</script>