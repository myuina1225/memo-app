<script setup lang="ts">
import TrashSvg from './svgs/TrashSvg.vue';

const props = defineProps<{
  id: number;
  content: string;
  createdAt: string;
}>();

const emit = defineEmits<{
  trashed: [id: number];
}>();
</script>

<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5 group">
    <div class="flex justify-between items-start gap-4">
      <div class="flex-1">
        <p class="text-gray-800 whitespace-pre-wrap">{{ content }}</p>
        <p class="text-xs text-gray-400 mt-3">{{ createdAt }}</p>
      </div>

      <button
        @click="emit('trashed', props.id)"
        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors opacity-0 group-hover:opacity-100"
        title="削除"
      >
        <TrashSvg />
      </button>
    </div>
  </div>
</template>