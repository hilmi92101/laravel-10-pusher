<template>     
    <Layout>   
        <h1>This is the Index page</h1><br>   
        <button><a href="#" @click.prevent="redirect('landing.page.about')">Go to About page</a></button>  
    </Layout>   
       
</template>     
<script setup>      
    import Layout from '@/Layouts/Landing.vue';   
    import { ref, } from 'vue'; 

    import { router } from '@inertiajs/vue3';

    const redirect = (routeName) => {    
        router.visit(route(routeName), { method: 'get' }) 
    }  
       
</script>