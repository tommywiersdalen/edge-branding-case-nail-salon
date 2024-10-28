<template>
    <form @submit.prevent="create">
        <Box>
            <div class="flex flex-col gap-y-4 mx-8">
                <label class="font-semibold text-xl" for="image">Bilde</label>
                <input class="file-select" type="file" name="image" id="image"
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
                <button class="w-1/3 btn-form" type="submit">Last
                    opp</button>
            </div>
        </Box>
    </form>
</template>
<script setup>
    import Box from '@/Components/Box.vue';
    import InputError from '@/Components/InputError.vue';

    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        image: null,
        heading: null,
        article: null,
    })
    const create = () => form.post(route('post.store'))
</script>