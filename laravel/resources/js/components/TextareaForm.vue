<script setup lang="ts">
import EditSvg from './svgs/EditSvg.vue';

const model = defineModel<string>();
</script>

<template>
  <div class="relative">
    <div
      v-if="model"
      class="absolute top-3 right-3 text-gray-300 opacity-40 pointer-events-none animate-pencil-wiggle"
    >
      <EditSvg />
    </div>

    <textarea
      v-model="model"
      rows="4"
      placeholder="タスクを入力してください...
（Enterで保存、Shift+Enterで改行）"
      class="w-full px-4 py-3 border rounded-lg outline-none resize-none text-gray-700 transition-colors"
      :class="model ? 'border-primary-400' : 'border-gray-200'"
    />
  </div>
</template>