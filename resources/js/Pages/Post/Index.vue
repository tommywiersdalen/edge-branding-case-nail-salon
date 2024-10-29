<template>
    <section v-if="posts.length" class="grid grid-cols-1 max-w-md  gap-y-4">
        <BlogPost v-for="post in posts" :post="post" :key="post.id" />
    </section>
    <section v-else>
        <h2 class="text-3xl">Ingen innlegg enda!</h2>
    </section>
</template>
<script setup>
    import BlogPost from './Components/BlogPost.vue';
    defineProps({
        posts: Array
    })

</script>