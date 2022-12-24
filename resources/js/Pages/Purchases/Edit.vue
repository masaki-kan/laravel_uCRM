<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/inertia-vue3';
import { onMounted, reactive,ref,computed } from 'vue';
import dayjs from 'dayjs'

//個数 option用
const quantity = [ "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
const itemList = ref([]);

const props = defineProps({ //constrolllerからきた値
  'order' : Array,
  'itmes' : Array,
});

onMounted(() => {
  props.itmes.forEach( itme => 
  {
    itemList.value.push({
      id: itme.id, 
      name: itme.name, 
      price: itme.price,
      quantity: itme.quantity 
    }) 
  }
  )
});

const form = reactive({
    id: props.order[0].id,
    date: dayjs(props.order[0].created_at).format("YYYY-MM-DD"), 
    customer_id: props.order[0].customer_id,
    status: props.order[0].status,
    items: []
});

//合計金額
const totalPrice = computed(()=>{ //computed()は監視　item.price * item.quantityの値が変われば即座に
  let total = 0;
  itemList.value.forEach( item  => {
    total += item.price * item.quantity
  } )

  return total;
});

const updatePurchase = id => {
  itemList.value.forEach( item => {
    if( item.quantity > 0 ){
      form.items.push({
         id : item.id, quantity: item.quantity 
      })
    }
  } );

  Inertia.put(route('purchases.update', { purchase: id }), form );
}

</script>
<template>
  <Head title="購買履歴の編集画面" />

  <AuthenticatedLayout>
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">購買履歴の編集画面</h2>
      </template>

      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="p-6 text-gray-900">
                    <section class="text-gray-600 body-font relative">
                      <form @submit.prevent="updatePurchase(form.id)">
                      <div class="container px-5 py-24 mx-auto">
                        <div class="lg:w-1/2 md:w-2/3 mx-auto">
                          <div class="flex flex-wrap -m-2">
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="date" class="leading-7 text-sm text-gray-600">日付</label>
                                <input disabled stype="date" id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                v-model="form.date">
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="customer_name" class="leading-7 text-sm text-gray-600">会員名</label>
                                <input disabled type="text" id="customer_name" name="customer_name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                v-model="props.order[0].customer_name">

                              </div>
                            </div>
  
                            <div class="p-2 w-full">
                              <div class="">
                                <label for="price" class="leading-7 text-sm text-gray-600">商品・サービス</label>
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                  <thead>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"></th>
                                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ID</th>
                                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">NAME</th>
                                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">PRICE</th>
                                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">quantity</th>  
                                  </thead>
                                  <tbody>
                                    <tr v-for="item in itemList" :key="item.id"> 
                                      <td class="px-4 py-3 border-gray-300 border-b-2">ID</td>
                                      <td class="px-4 py-3 border-gray-300 border-b-2">{{ item.id }}</td>
                                      <td class="px-4 py-3 border-gray-300 border-b-2">{{ item.name }}</td>
                                      <td class="px-4 py-3 border-gray-300 border-b-2">{{ item.price }}</td>
                                      <td class="px-4 py-3 borde">
                                        <select name="quantity" v-model="item.quantity"> 
                                          <option v-for="q in quantity" :key="q" :value="q">{{ q }}</option>
                                        </select>
                                      </td>
                                  </tr>
                                  </tbody>
                              </table>
                              </div>
                            </div>

                            <div class="p-2 w-full">
                              <div class="">
                                <label for="date" class="leading-7 text-sm text-gray-600">合計</label>
                                <span class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300  focus:border-indigo-500 focus:bg-white">{{totalPrice}}円</span>
                              </div>
                            </div>

                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="status" class="leading-7 text-sm text-gray-600">ステータス</label>
                                <div>
                                  <input type="radio" name="status" v-model="form.status" value="1">未キャンセル 
                                  <input type="radio" name="status" v-model="form.status" value="0">キャンセル済
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

