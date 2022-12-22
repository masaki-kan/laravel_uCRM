<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
import { reactive } from '@vue/reactivity';

const props = defineProps({
  errors : Object,
  item : Object
});

const form = reactive({
  id : props.item.id,
  name : props.item.name,
  price : props.item.price,
  memo : props.item.memo,
  is_selling : props.item.is_selling,
});

const updateItem = (id) => {
  Inertia.put( route('items.update',{item : id}),form);
};


</script>

<template>
  <Head title="商品情報更新" />
  <AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品情報更新</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                <section class="text-gray-600 body-font relative">
                  <form @submit.prevent="updateItem(form.id)">
                  <div class="container px-5 py-24 mx-auto">
                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                      <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-full">
                          <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                            <div v-if="errors.name">{{errors.name}}</div>
                            <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="form.name"/>
                          </div>
                        </div>
                        <div class="p-2 w-full">
                          <div class="relative">
                            <label for="memo" class="leading-7 text-sm text-gray-600">Memo</label>
                            <div v-if="errors.memo">{{errors.memo}}</div>
                            <textarea id="message" name="memo" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"
                            v-model="form.memo"></textarea>
                          </div>
                        </div>
                        <div class="p-2 w-full">
                          <div class="relative">
                            <label for="price" class="leading-7 text-sm text-gray-600">Price</label>
                            <div v-if="errors.price">{{errors.price}}</div>
                            <input type="number" id="price" name="price" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="form.price">
                          </div>
                        </div>
                        <div class="p-2 w-full">
                          <div class="relative">
                            <label class="leading-7 text-sm text-gray-600">ステータス</label>
                            <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out mb-4">
                              <input type="radio" name="is_selling" id="is_selling_1" v-model="form.is_selling" value="1" />
                            <label for="is_selling_1" class="ml-2 mr-4">販売中</label>
                            </div>
                            <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              <input type="radio" name="is_selling" id="is_selling_2" v-model="form.is_selling" value="0" />
                              <label for="is_selling_2" class="ml-2 mr-4">販売中止</label>
                            </div>
                          </div>
                        </div>
                        <div class="p-2 w-full">
                          <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
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
