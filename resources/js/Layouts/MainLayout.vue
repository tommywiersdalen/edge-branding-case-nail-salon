<template>
    <div class="flex flex-col min-h-svh">
        <header class="w-full bg-main">
            <nav class="flex flex-col items-center mb-4 md:flex-row md:justify-between md:mx-12">
                <Link :href="route('post.index')">
                <img class="my-6" src="\images\assets\logo.png" alt="Turids Neglsalog logo">
                </Link>
                <div class="flex gap-2" v-if="user">
                    <Link
                        class="rounded-full px-4 py-2 border border-author text-white text-base bg-main hover:bg-mainHover"
                        :href="route('post.create')">
                    <FontAwesomeIcon class="mr-2 h-4" icon="fa-plus" /> Ny Bloggpost
                    </Link>
                    <Link class="rounded-full px-4 py-2  text-white text-base bg-author hover:bg-authorHover"
                        :href="route('logout')" method="post" as="button">
                    <FontAwesomeIcon class="mr-2 h-4 rotate-180" icon="fa-right-to-bracket" /> Logg ut
                    </Link>
                </div>
                <div v-else>
                    <Link class="rounded-full px-4 py-2  text-white text-base bg-author hover:bg-authorHover"
                        href="login">
                    <FontAwesomeIcon class="mr-2 h-4" icon="fa-right-to-bracket" /> Logg inn
                    </Link>
                </div>
            </nav>
        </header>
        <div class=" flex justify-end">
            <FlashMessage v-if="flashSuccess" :message="flashSuccess" />
        </div>
        <main class="flex grow items-center justify-center mt-8 mb-8 ">
            <slot>Default</slot>
        </main>
        <footer class="bg-main w-full relative">
            <img src="/images/assets/footer.png" alt="">
        </footer>
    </div>
</template>
<script setup>

    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { Link, usePage } from '@inertiajs/vue3';
    import { computed } from 'vue';

    import FlashMessage from '@/Components/FlashMessage.vue';

    const page = usePage()

    const user = computed(() => page.props.user)
    const flashSuccess = computed(() => page.props.flash.success)

</script>
