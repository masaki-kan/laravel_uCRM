<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

defineProps({
  item : Object
})

function nl2br(str) {
  var res = str.replace(/\r\n/g, "<br>");
  res = res.replace(/(\n|\r)/g, "<br>");
  return res;
}

const deleteItem = (id) => {
  Inertia.delete( route('items.destroy',{item : id}) ,
  {
    onBefore : () => confirm('本当に削除しますか？'),
  });
};

</script>

<template>
    <Head title="商品情報" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品情報</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                      <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-24 mx-auto">
                          <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <div class="flex flex-wrap -m-2">
                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label class="leading-7 text-sm text-gray-600">Name</label>
                                  <div class="w-full  bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ item.name }}</div>
                                </div>
                              </div>
                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label class="leading-7 text-sm text-gray-600">Memo</label>
                                  <div class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" v-html="nl2br(item.memo)" />
                                </div>
                              </div>
                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label class="leading-7 text-sm text-gray-600">Price</label>
                                  <div class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ item.price }}</div>
                                </div>
                              </div>
                              <div class="p-2 w-full">
                                <div class="relative">
                                  <label class="leading-7 text-sm text-gray-600">ステータス</label>
                                  <div class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <span v-if="item.is_selling === 1">販売中</span>
                                    <span v-if="item.is_selling === 0">販売中止</span>
                                  </div>
                                </div>
                              </div>
                              <div class="p-2 w-full">
                                <Link class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" as="button" :href="route('items.edit',{item :item.id})">編集する</Link>
                              </div>
                              <div class="p-2 w-full">
                                <button @click="deleteItem(item.id)">削除する</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
