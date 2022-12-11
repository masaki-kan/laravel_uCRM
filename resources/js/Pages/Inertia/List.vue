<script setup>
import { Inertia } from '@inertiajs/inertia'
import  GuestLayout  from '../../Layouts/GuestLayout.vue'
import  InputLabel  from '../../Components/InputLabel.vue'
import  TextInput  from '../../Components/TextInput.vue'
  defineProps({
    lists : Array
  })

const deleteDate = (id) => {
  Inertia.delete('/inertia/delete/'+id,{
    onBefore : () => confirm(id+'を削除しますか？') 
  }
  )
}

const inputText = e => console.log(e)

</script>

<template>
  <div v-if="$page.props.flash.message">{{$page.props.flash.message}}</div>
  <ul>
    <li v-for="list in lists" :key="list.id">
    <div>
      ID : {{ list.id }}<br>
      TITLE : {{ list.title }}<br>
      CONTNET : {{ list.content }}<br>
      <button @click="deleteDate(list.id)">削除</button>
    </div>
    </li>
  </ul>

  <GuestLayout>
<InputLabel value="件名">タイトル</InputLabel>
<TextInput modelValue="初期値" @update:modelValue="inputText"></TextInput>
  </GuestLayout>
</template>
