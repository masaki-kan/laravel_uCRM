<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import { onMounted } from '@vue/runtime-core';
import Paginate from '@/Components/Paginate.vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
  customers : Object
})


const search = ref("");

const searchCustomers = () => {
  Inertia.get(route('customer.index',{ search : search.value }) )
}


</script>

<template>
    <Head title="顧客一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">
                            <FlashMessage />
                            <div class="flex pl-4 pb-4 lg:w-2/3 w-full mx-auto">
                                <Link as="button" :href="route('customer.create')" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">顧客登録</Link>
                            </div>
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                              <div class="mb-6">
                                  <input type="text" name="search" v-model="search"> <button class="bg-blue-300 text-white py-2 px-2"
                                  @click="searchCustomers">検索</button>
                              </div>
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">name</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">kana</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">email</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">tel</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="customer in customers.data" :key="customer.id">
                                        <td class="px-4 py-3">{{customer.id}}</td>
                                        <td class="px-4 py-3"><Link :href="route('customer.show',{ id :customer.id})" >{{customer.name}}</Link></td>
                                        <td class="px-4 py-3">{{customer.kana}}</td>
                                        <td class="px-4 py-3">{{customer.email}}</td>
                                        <td class="px-4 py-3">{{customer.tel}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <Paginate class="mt-6" :links="customers.links" />
                            </div>
                            <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                                <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
