<template>
    <Head title="Create User"></Head>
    <h1 class="text-3xl">
        Create User
    </h1>
    <form @submit.prevent="submit" class="max-w-md mx-auto mt-8" novalidate>
        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                Name
            </label>
            <input type="text" v-model="form.name" name="name" id="name" required class="border border-gray-400 p-2 w-full">
            <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                Email
            </label>
            <input type="email" v-model="form.email" name="email" id="email" required class="border border-gray-400 p-2 w-full">
            <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                Password
            </label>
            <input type="password" v-model="form.password" name="password" id="password" required class="border border-gray-400 p-2 w-full">
            <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <button type="submit" class="bg-blue-400 text-white py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Submit</button>
        </div>
    </form>
</template>

<script setup>

// import { reactive, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";


// defineProps({
//     errors: Object
// });


// let form = reactive({
//     name: '',
//     email: '',
//     password: ''
// })
// let processing = ref(false);

// let submit = () => {
//     // processing.value = true;
//     Inertia.post('/users', form, {
//         onStart: () => { processing.value = true },
//         onFinish: () => { processing.value = false }
//     });
// }

let form = useForm({
    name: '',
    email: '',
    password: ''
});

// setTimeout(() => {
//     form.reset();
// }, 3000)

let submit = () => {
    form.post('/users');
}



</script>
