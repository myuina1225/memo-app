<script setup lang="ts">
import PlusSvg from './svgs/PlusSvg.vue';

defineProps<{
  disabled: boolean;
}>();
</script>

<template>
  <button
    :disabled="disabled"
    class="w-full py-3 px-6 rounded-lg font-medium transition-all duration-200 flex items-center justify-center gap-2"
    :class="disabled
      ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
      : 'bg-primary-500 text-white hover:bg-primary-600'"
  >
    <PlusSvg />
    メモを保存
  </button>
</template>
