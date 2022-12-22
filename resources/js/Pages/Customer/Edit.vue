<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Core as YubinBangoCore } from "yubinbango-core2"; //Vue.js 郵便番号検索  ライブラリインストール
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
import { reactive } from '@vue/reactivity';

const props = defineProps({
  errors : Object,
  customers : Object
})

const form = reactive({
  id : props.customers.id,
  name : props.customers.name,
  kana : props.customers.kana,
  tel : props.customers.tel,
  email : props.customers.email,
  postcode : props.customers.postcode,
  address: props.customers.address,
  birthday :props.customers.birthday,
  gender: props.customers.gender,
  memo :props.customers.memo
})

// 数字を文字に変換 第1引数が郵便番号、第2がコールバックで引数に住所 
const fetchAddress = () => {
  new YubinBangoCore(String(form.postcode), (value) => {
     form.address = value.region + value.locality + value.street
  }
)}

const updateCustomers = () => {
  Inertia.put( route('customers.update',{customer : form.id}),form);
}

</script>

<template>
    <Head title="顧客登録" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客登録</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                      <section class="text-gray-600 body-font relative">
                        <form @submit.prevent="updateCustomers">
                          <div class="container px-5 py-24 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                              <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                                    <div v-if="errors.name">{{errors.name}}</div>
                                    <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    v-model="form.name">
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="kana" class="leading-7 text-sm text-gray-600">kana</label>
                                    <div v-if="errors.kana">{{errors.kana}}</div>
                                    <input type="text" id="kana" name="kana" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    v-model="form.kana">
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="email" class="leading-7 text-sm text-gray-600">email</label>
                                    <div v-if="errors.email">{{errors.email}}</div>
                                    <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    v-model="form.email">
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="tel" class="leading-7 text-sm text-gray-600">tel</label>
                                    <div v-if="errors.tel">{{errors.tel}}</div>
                                    <input type="tel" id="tel" name="tel" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    v-model="form.tel">
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="postcode" class="leading-7 text-sm text-gray-600">postcode</label>
                                    <div v-if="errors.postcode">{{errors.postcode}}</div>
                                    <input type="number" id="postcode" name="postcode" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    @change="fetchAddress"
                                    v-model="form.postcode">
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="address" class="leading-7 text-sm text-gray-600">address</label>
                                    <div v-if="errors.address">{{errors.address}}</div>
                                    <input type="text" id="address" name="address" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    v-model="form.address">
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="address" class="leading-7 text-sm text-gray-600">birthday</label>
                                    <div v-if="errors.birthday">{{errors.birthday}}</div>
                                    <input type="date" id="birthday" name="birthday" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    v-model="form.birthday">
                                  </div>
                                </div>  
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="memo" class="leading-7 text-sm text-gray-600">memo</label>
                                    <div v-if="errors.memo">{{errors.memo}}</div>
                                    <textarea id="message" name="memo" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"
                                    v-model="form.memo"></textarea>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label class="leading-7 text-sm text-gray-600">sex</label>
                                    <div v-if="errors.gender">{{errors.gender}}</div>
                                      <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out mb-4">
                                        <input type="radio" name="gender" id="gender_1" v-model="form.gender" value="1" />
                                      <label for="gender_1" class="ml-2 mr-4">man
                                    </label>
                                    </div>
                                    <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out mb-4">
                                        <input type="radio" name="gender" id="gender_2" v-model="form.gender" value="0" />
                                        <label for="gender_2" class="ml-2 mr-4">woman</label>
                                    </div>
                                    <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                      <input type="radio" name="gender" id="gender_3" v-model="form.gender" value="2" />
                                      <label for="gender_3" class="ml-2 mr-4">other</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
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
