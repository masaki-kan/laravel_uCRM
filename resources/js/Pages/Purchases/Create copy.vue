<script setup>
import { Inertia } from '@inertiajs/inertia';
import { getToday } from '@/common.js';
import { onMounted, reactive,ref,computed } from 'vue';

const props = defineProps({
  customers : Array,
  items : Array,
  errors : Object
})

const form = reactive(
  { 
    date: null, //日付
    customer_id : null, //購入者のid
    status : true,
    items : []
  }
)
const itemList = ref([]) // リアクティブな配列を準備

onMounted(() => { // ページ読み込み後 即座に実行 ページ読み込む前に実行するときはcreatedを使う
  form.date = getToday()

  //propsのままだと変更できないので新たに配列を作って追加 販売中のItemをv-forで全て表示 数量は初期値0
  props.items.forEach( item => { // 配列を1つずつ処理
    itemList.value.push({ // 配列に1つずつ追加
    id: item.id, name: item.name, price: item.price, quantity: 0 })
})
})

//個数 option用
const quantity = [ "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"] 

//合計金額
const totalPrice = computed(()=>{ //computed()は監視　item.price * item.quantityの値が変われば即座に
  let total = 0;
  itemList.value.forEach( item  => {
    total += item.price * item.quantity
  } )

  return total;

})

const storePurchase = () => {
  itemList.value.forEach( item => {
    if( item.quantity > 0 ){
      form.items.push({
         id : item.id, quantity: item.quantity 
      })
    }
  } )

  Inertia.post( route('purchases.store') , form);
}

</script>

<template>
  <form @submit.prevent="storePurchase">
  日付<br>
<input type="date" name="date" v-model="form.date"><br>
会員名<br>
<div v-if="errors.customer_id">{{errors.customer_id}}</div><br>
<select name="customer_id" v-model="form.customer_id">
<option v-for="customer in props.customers" :value="customer.id" :key="customer.id">
{{ customer.id }} : {{ customer.name }}
</option> 
</select>
商品・サービス<br>
<table>
  <tbody>
    <tr v-for="item in itemList" :key="item.id"> 
      <td>{{ item.id }}</td>
      <td>{{ item.name }}</td> 
      <td>{{ item.price }}</td> 
      <td>
        <select name="quantity" v-model="item.quantity"> 
          <option v-for="q in quantity" :key="q" :value="q">{{ q }}</option>
        </select>
      </td>
      <td>
        {{ item.price * item.quantity }}
      </td> 
    </tr>
  </tbody> 
</table>
合計 {{ totalPrice }} 円
<button type="submit">登録</button>
</form>
</template>
