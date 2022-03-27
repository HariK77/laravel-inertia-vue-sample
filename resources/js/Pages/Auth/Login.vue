<template>
    <Head title="Login"></Head>
    <main class="grid place-items-center min-h-screen">
        <section class="bg-white p-8 rounded-xl max-w-md mx-auto border">
            <h1 class="text-3xl mb-6">
                Login
            </h1>
            <form @submit.prevent="submit" class="" novalidate>
                <div class="mb-6">
                    <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Email
                    </label>
                    <input type="email" v-model="form.email" name="email" id="email" required class="border rounded p-2 w-full">
                    <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Password
                    </label>
                    <input type="password" v-model="form.password" name="password" id="password" required class="border rounded p-2 w-full">
                    <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
                </div>
                <div class="mb-6">
                    <button type="submit" class="bg-blue-400 text-white py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Login</button>
                </div>
            </form>
        </section>
    </main>
</template>

<script>
// import Nav from "../Shared/Nav"
// import Layout from '../Shared/Layout'
export default {
    layout: null
}
</script>

<script setup>

import { useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
    email: '',
    password: ''
});

// setTimeout(() => {
//     form.reset();
// }, 3000)

let submit = () => {
    form.post('/login');
}

</script>

<style>

</style>
