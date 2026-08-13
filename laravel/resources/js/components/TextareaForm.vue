<script setup lang="ts">
const model = defineModel<string>();
</script>

<template>
  <textarea
    v-model="model"
    rows="4"
    placeholder="メモを入力してください...
（Enterで保存、Shift+Enterで改行）"
    class="w-full px-4 py-3 border rounded-lg outline-none resize-none text-gray-700 transition-colors"
    :class="model ? 'border-primary-400' : 'border-gray-200'"
  />
</template>
