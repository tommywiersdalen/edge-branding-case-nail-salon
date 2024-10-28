<template>
    <Transition enter-active-class="transition-opacity duration-500"
        leave-active-class="transition-opacity duration-500" enter-from-class="opacity-0" leave-to-class="opacity-0">
        <div v-if="isVisible"
            class="flex justify-between my-2 transition-all duration-100 rounded-md mx-4 items-center w-[400px] p-4 bg-green-800 gap-3">
            <div class="text-white">{{ message }}</div>
            <button class="text-white hover:text-blue-300 text-lg" @click="hideMessage">&times;</button>
        </div>
    </transition>
</template>
<script setup>
    import { ref, onMounted } from 'vue';

    const props = defineProps({
        message: String,
    });

    const isVisible = ref(false);

    const hideMessage = () => {
        isVisible.value = false;
    }

    onMounted(() => {
        isVisible.value = true;
    });
    setTimeout(() => {
        isVisible.value = false
    }, 3000);
</script>