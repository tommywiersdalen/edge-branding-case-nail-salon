<template>
    <Box>
        <div class="flow-text break-words mx-8 py-4">
            <img class="rounded-md mb-4" v-if="props.post.image" :src="post.image" alt="">
            <h1 class="text-3xl mb-2 font-serif">{{ props.post.heading }}</h1>
            <p class="mb-6 ">{{ props.post.article }}</p>
            <div class="mb-2 flex justify-between items-center">
                <div>
                    <p class="text-xs text-author">Skrevet av</p>
                    <div class="text-sx font-semibold">{{ props.post.user.name }}</div>
                </div>
                <div class="flex ml-2 gap-2">
                    <Link v-if="user" class="action-btn" :href="route('post.edit', { post: props.post.id })">
                    <FontAwesomeIcon icon="fa-pen-to-square" />
                    </Link>
                    <button v-if="user" type="button" @click="openModal" class="action-btn">
                        <FontAwesomeIcon icon="fa-trash-can" />
                    </button>
                </div>
            </div>
        </div>
    </Box>
    <Modal :show="confirmDeletePost" @close="closeModal">
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-3xl font-medium mb-2">Er du sikker på at du vil slette innlegget?</h1>
            <div>
                <FontAwesomeIcon icon="fa-circle-exclamation" size="6x" class=" text-red-600" />
            </div>
            <div class="flex gap-2 my-4">
                <button class="btn-form" @click="deletePost">Slett</button>
                <button class="btn-form" @click="closeModal">Avbryt</button>
            </div>
        </div>
    </Modal>
</template>
<script setup>
    import Box from '@/Components/Box.vue';
    import Modal from '@/Components/Modal.vue';


    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { Link, usePage, useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';

    const props = defineProps({ post: Object })
    const user = usePage().props.auth.user;

    const form = useForm({
        post: props.post
    })

    let confirmDeletePost = ref(false)

    const openModal = () => {
        confirmDeletePost.value = true
    }
    const closeModal = () => {
        confirmDeletePost.value = false
    }

    const deletePost = () => {
        form.delete(route('post.destroy', { post: props.post.id }), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
        })
    }

</script>