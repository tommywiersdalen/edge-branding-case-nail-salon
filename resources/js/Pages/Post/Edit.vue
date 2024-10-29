<template>
    <form @submit.prevent="update">
        <Box>
            <div class="flex flex-col gap-y-4 mx-8 max-w-md">
                <label class="font-semibold text-xl" for="image">Bilde</label>
                <div v-if="props.post.image"> <img class=" rounded-md mb-4" :src="'/' + props.post.image" alt="">
                    <div class="flex justify-end"><button class="btn-form" type="button"
                            @click="resetImage">Fjern</button>
                    </div>
                </div>
                <input v-else class="file-select" type="file" name="image" id="image"
                    @input="form.image = $event.target.files[0]">
                <InputError :message="form.errors.image" />
                <label class="font-semibold text-xl" for="heading">Overskrift</label>
                <input class="form-input" type="text" name="heading" id="heading" v-model="form.heading">
                <InputError :message="form.errors.heading" />
                <label class="font-semibold text-xl" for="article">Brødtekst</label>
                <textarea class="form-input" name="article" id="article" v-model="form.article"></textarea>
                <InputError :message="form.errors.article" />
            </div>
            <div class="flex justify-end mt-4 mx-8">
                <button class="w-1/3 btn-form" type="submit">
                    Lagre
                </button>
            </div>
        </Box>
    </form>
</template>
<script setup>
    import Box from '@/Components/Box.vue';
    import InputError from '@/Components/InputError.vue';


    import { useForm } from '@inertiajs/vue3';


    const props = defineProps({
        post: Object
    })


    const form = useForm({
        image: props.post.image,
        heading: props.post.heading,
        article: props.post.article,
    })

    const resetImage = () => form.image = null
    const update = () => form.post(route('post.update', { _method: 'put', post: props.post.id }))
</script>