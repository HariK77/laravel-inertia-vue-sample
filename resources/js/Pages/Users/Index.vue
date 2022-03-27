<template>
    <Head>
        <title>Users</title>
        <meta type="description" content="Users Information" head-key="description">
    </Head>

    <!-- <div style="margin-top: 900px">

        <p>Now time is {{ time }}</p>

        <Link
            href="/users"
            class="text-blue-5pp"
            preserve-scroll
        >
        Refresh
        </Link>

    </div> -->

    <div class="flex justify-between mb-6">
        <div class="flex items-center">
            <h1 class="text-3xl">Users</h1>
            <Link v-if="can.createUser" href="/users/create" class="text-blue-500 text-sm ml-3">New User</Link>
        </div>
        <input type="text" v-model="search" placeholder="Search..." class="border px-2 rounded-lg">
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="user in users.data" :key="user.id" >
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ user.name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <Link v-if="user.can.edit" :href="`/users/${user.id}/edit`" class="text-indigo-500 hover:text-indigo-900">Edit</Link>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <Link v-if="user.can.delete" method="delete" :href="`/users/${user.id}`" as="button" class="text-red-500 hover:text-red-900">Delete</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- pagination -->
    <div class="mt-6 text-center">
        <Pagination :links="users.links" />
    </div>
</template>

<script setup>
// composotion api
import Pagination from "../../Shared/Pagination";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
// import throttle from "lodash/throttle";
import debounce from "lodash/debounce";

let props = defineProps({
    users: Object,
    filters: Object,
    can: Object
});

let search = ref(props.filters.search);

// watch(search, throttle(function (value) {
//     // console.log(value);
//     Inertia.get('/users', { search: value }, {
//         preserveState: true,
//         replace: true
//     });
// }, 500));

watch(search, debounce(function (value) {
    // console.log(value);
    Inertia.get('/users', { search: value }, {
        preserveState: true,
        replace: true
    });
}, 500));


// Normal options api
// import Pagination from "../Shared/Pagination"
// // import Layout from '../Shared/Layout'
// // import { Link } from "@inertiajs/inertia-vue3"
// export default {
//     // layout: Layout,
//     props: {
//         users: Object,
//     },
//     components: {
//         Pagination
//     }
// }
</script>

<style>

</style>
