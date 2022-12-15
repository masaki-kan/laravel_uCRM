<script setup>
</script>

<template>
  <div v-if="$page.props.flash.status" class="bg-blue-300 text-white p-4 mb-3"> 
    {{$page.props.flash.message}}
  </div>
</template>
