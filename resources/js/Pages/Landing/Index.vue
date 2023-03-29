<template>     
    <Layout>   
        <h1>This is the Index page</h1><br>   
        <button><a href="#" @click.prevent="redirect('landing.page.about')">Go to About page</a></button>  
    </Layout>   
       
</template>     
<script setup>      
    import Layout from '@/Layouts/Landing.vue';   
    import { ref, onMounted} from 'vue'; 

    import { router } from '@inertiajs/vue3';

    const redirect = (routeName) => {    
        router.visit(route(routeName), { method: 'get' }) 
    }  

    onMounted(() => { 
        
        let config = {
            headers: {
                'Accept': 'application/json',
            }
        }

        axios.post(route('visitor.createToken'), config)
        .then((response) => {
            console.log(response.data);
            var token = response.data.token;
            localStorage.setItem('visitor_token', token);

            console.log(window.EchoPresence)
            window.EchoPresence
                .join('visitor-counter', () => {
                    console.log('Joined visitors-counter channel');
                })
                .here(users => {
                    console.log(`Visitors-counter channel has ${users.length} users`);
                    console.log(users);
                })
                .joining(user => {
                    console.log(`User ${user.id} joined the visitors-counter channel`);
                    console.log(user);
                })
                .leaving(user => {
                    console.log(`User ${user.id} left the visitors-counter channel`);
                    console.log(user);
                });
        })
        .catch(function (error) {
            // Handle error
        });

    });
       
</script>