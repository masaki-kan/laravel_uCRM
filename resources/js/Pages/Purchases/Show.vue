<script setup>
import { Inertia } from '@inertiajs/inertia';
import { onMounted, reactive,ref,computed } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import dayjs from 'dayjs'

const props = defineProps({
  order : Array,
  items : Array,
})

</script>

<template>
    <Head title="購買履歴　詳細画面" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">購買履歴　詳細画面</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                      <section class="text-gray-600 body-font relative">
                        <form @submit.prevent="storePurchase">
                        <div class="container px-5 py-24 mx-auto">
                          <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <div class="flex flex-wrap -m-2">
                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label for="date" class="leading-7 text-sm text-gray-600">日付</label>
                                    <div id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    >
                                    {{ dayjs(props.order[0].created_at).format('YYYY-MM-DD HH:mm:ss') }}
                                    </div>
                                </div>
                              </div>
                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label for="date" class="leading-7 text-sm text-gray-600">会員名</label>
                                  <div id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    >
                                    {{ props.order[0].customer_name}}
                                    </div>
                                </div>
                              </div>

                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label for="date" class="leading-7 text-sm text-gray-600">合計金額</label>
                                  <div id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    >
                                    {{ props.order[0].total}}円
                                    </div>
                                </div>
                              </div>

                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label for="date" class="leading-7 text-sm text-gray-600">ステータス</label>
                                  <div v-if="props.order[0].status == true" id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    >
                                    キャンセル
                                    </div>
                                    <div v-if="props.order[0].status == false" id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    >
                                    キャンセル済み
                                    </div>
                                </div>
                              </div>

                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label for="date" class="leading-7 text-sm text-gray-600">キャンセル日</label>
                                  <div v-if="props.order[0].status == false"  id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    >
                                    {{ dayjs(props.order[0].updated_at).format('YYYY-MM-DD HH:mm:ss') }}
                                    </div>
                                </div>
                              </div>
    
                              <div class="p-2 w-full">
                                <div class="">
                                  <label for="price" class="leading-7 text-sm text-gray-600">購入商品</label>
                                  <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"></th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ID</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">NAME</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">数量</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">PRICE</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">小計</th>  
                                    </thead>
                                    <tbody>
                                      <tr v-for="item in props.items" :key="item.id"> 
                                        <td class="px-4 py-3 border-gray-300 border-b-2">ID</td>
                                        <td class="px-4 py-3 border-gray-300 border-b-2">{{ item.id }}</td>
                                        <td class="px-4 py-3 border-gray-300 border-b-2">{{ item.item_name }}</td>
                                        <td class="px-4 py-3 border-gray-300 border-b-2">{{ item.quantity }}</td>
                                        <td class="px-4 py-3 border-gray-300 border-b-2">{{ item.item_price }}</td>
                                        <td class="px-4 py-3 border-gray-300 border-b-2">{{ item.subtotal }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                              </div>
                              <div v-if="props.order[0].status == true" class="p-2 w-full">
                                  <Link  :href="route('purchases.edit' ,{ purchase : props.order[0].id })">編集する</Link>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
