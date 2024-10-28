<template>
    <section class="grid grid-cols-1 max-w-md  gap-y-4">
        <BlogPost v-if="posts.length" v-for="post in posts" :post="post" :key="post.id" />
        <h2 v-else class="text-3xl">Ingen innlegg enda!</h2>
    </section>
</template>
<script setup>
    import BlogPost from './Components/BlogPost.vue';
    defineProps({
        posts: Array
    })

</script>