<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { reactive, onMounted } from 'vue' 
import { getToday } from '@/common'
import Chart from '@/Components/Chart.vue'

defineProps({
  period : Array
});

onMounted(() => {
  form.startDate = getToday() 
  form.endDate = getToday()
});

const data = reactive({});

const form = reactive({ 
  startDate: null, 
  endDate: null,
  type: 'perDay' 
});

const getData = async () => {
  try{
    await axios.get('/api/analysis/', { params: {
    startDate: form.startDate, 
    endDate: form.endDate, 
    type: form.type
    } })
    .then( res => {
    data.data = res.data.data;
    data.labels = res.data.labels; 
    data.totals = res.data.totals;
    console.log(data)
    })
  } catch (e){
    console.log(e.message)
  }
};


</script>

<template>
    <Head title="データ分析" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">データ分析</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                      <form @submit.prevent="getData">
                        From: <input type="date" name="startDate" v-model="form.startDate"> To: 
                        <input type="date" name="endDate" v-model="form.endDate"> <br>
                        <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">分析する</button>
                      </form>

                      <Chart :data="data"/>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
