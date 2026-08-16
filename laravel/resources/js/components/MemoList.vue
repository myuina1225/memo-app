<script setup lang="ts">
import DocumentSvg from './svgs/DocumentSvg.vue';
import MemoItem from './MemoItem.vue';

const mockMemos = [
  { id: 1, content: 'Vue.jsの基本構文を復習する', created_at: '2026-08-10 10:30' },
  { id: 2, content: 'Laravelのルーティングについて調べる', created_at: '2026-08-10 09:15' },
];
</script>

<template>
  <div>
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
        <DocumentSvg />
        保存されたメモ
      </h2>
      <span class="text-sm text-gray-500 bg-orange-100 px-3 py-1 rounded-full">
        {{ mockMemos.length }}件
      </span>
    </div>

    <div class="space-y-4">
      <MemoItem
        v-for="memo in mockMemos"
        :key="memo.id"
        :content="memo.content"
        :created-at="memo.created_at"
      />
    </div>
  </div>
</template>
