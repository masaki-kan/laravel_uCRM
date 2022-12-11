<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { reactive, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia'

defineProps({
  errors: Object,
});

const form = reactive({
  title: null,
  content: null,
})

const submitFunction = () => {
  Inertia.post('/inertia/store',
    form
  )
}

</script>
<template>
  <form @submit.prevent="submitFunction">
    <input type="text" name="title" v-model="form.title"/><br>
    <div v-if="errors.title" class="errorsText">{{errors.title}}</div><br>
    <input type="text" name="content" v-model="form.content"/><br>
    <div v-if="errors.content" class="errorsText">{{errors.content}}</div><br>
    <button>Submit</button>
  </form>
  <div v-if="$page.props.flash.message" class="blue">{{ $page.props.flash.message }}</div>

  <Link :href="route('inertia.show',{id :1})">ルートパラメータのテスト</Link><br>
  <Link :href="route('inertia.list')">データリスト</Link>
</template>

<style scoped>
.errorsText{
  color :#ff0000
}
.blue{
  color :blue
}
</style>
