<script setup lang="ts">
import DocumentSvg from './svgs/DocumentSvg.vue';
import MemoItem from './MemoItem.vue';

defineProps<{
  memos: { id: number; content: string; created_at: string }[];
}>();

const emit = defineEmits<{
  trashed: [id: number];
  edited: [id: number, content: string];
}>();
</script>

<template>
  <div>
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
        <DocumentSvg />
        保存されたメモ
      </h2>
      <span class="text-sm text-gray-500 bg-orange-100 px-3 py-1 rounded-full">
        {{ memos.length }}件
      </span>
    </div>

    <div class="space-y-4">
      <MemoItem
        v-for="memo in memos"
        :key="memo.id"
        :id="memo.id"
        :content="memo.content"
        :created-at="memo.created_at"
        @trashed="emit('trashed', $event)"
        @edited="(id, content) => emit('edited', id, content)"
      />
    </div>
  </div>
</template>