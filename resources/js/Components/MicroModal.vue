<script setup>
import { ref ,onMounted, reactive} from 'vue'
import axios from 'axios'
const isShow = ref(false)
const search = ref('')
const customers = reactive({})
const toggleStatus = () => { isShow.value = !isShow.value}
const emit = defineEmits(['update:customerId']) //親に渡す

const searchCustomer = async () => { //dbからデータを取得してから下記の処理を走らせる
  try{
    await axios.get(`/api/searchCustomers/?search=${search.value}`) // inputで入力された値を引数に 
    //awaitで処理が完了するまで、モダールは表示させない
      .then( res => {
        customers.value = res.data;
      })
      toggleStatus();
  }catch(e){
    console.log(e.message);
  }
}

const setCustomer = e => { 
  search.value = e.kana;
  emit('update:customerId', e.id);
  toggleStatus();
}

</script>
<template>  
  <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container w-2/3" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            顧客検索
          </h2>
          <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <div v-if="customers.value" class="lg:w-2/3 w-full mx-auto overflow-auto">
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
                <tr v-for="customer in customers.value.data" :key="customer.id">
                    <td class="px-4 py-3"><button @click="setCustomer({id:customer.id ,kana:customer.kana})" type="button" class="text-blue-400">{{customer.id}}</button></td>
                    <td class="px-4 py-3">{{customer.name}}</td>
                    <td class="px-4 py-3">{{customer.kana}}</td>
                    <td class="px-4 py-3">{{customer.email}}</td>
                    <td class="px-4 py-3">{{customer.tel}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </main>
        <footer class="modal__footer">
          <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
        </footer>
      </div>
    </div>
  </div>
  <input type="text" name="customer" v-model="search" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br>
  <button type="button" @click="searchCustomer" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg mt-3">検索する</button>
</template>
