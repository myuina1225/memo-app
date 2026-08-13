<script setup lang="ts">
import DocumentSvg from './svgs/DocumentSvg.vue';
</script>

<template>
  <header class="bg-white shadow-sm border-b border-orange-100">
    <div class="max-w-2xl mx-auto px-6 py-6 text-center">
      <h1 class="text-3xl font-bold text-gray-800 flex items-center justify-center gap-3">
        <DocumentSvg />
        かんたんメモ
      </h1>
      <p class="text-gray-600 mt-2 text-sm">
        思いついたことをサッと記録しよう
      </p>
    </div>
  </header>
</template>
