<script setup lang="ts">
import DocumentSvg from './svgs/DocumentSvg.vue';
import MemoItem from './MemoItem.vue';

defineProps<{
  memos: { id: number; content: string; created_at: string; is_favorite: boolean; color: string }[];
}>();

const searchQuery = defineModel<string>('searchQuery');

const emit = defineEmits<{
  trashed: [id: number];
  edited: [id: number, content: string];
  favorited: [id: number, isFavorite: boolean];
}>();
</script>

<template>
  <div>
    <div class="chalkboard p-6 pb-4">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-white flex items-center gap-2">
          <DocumentSvg class="text-white" />
          タスク一覧
        </h2>
        <span class="text-sm text-white bg-white/20 px-3 py-1 rounded-full">
          {{ memos.length }}件
        </span>
      </div>

      <input
        v-model="searchQuery"
        type="text"
        placeholder="タスクを検索..."
        class="w-full mb-4 px-3 py-2 rounded-lg border-none outline-none text-sm"
      />

      <TransitionGroup name="flip" tag="div" class="space-y-4 min-h-24" style="perspective: 800px;">
        <MemoItem
          v-for="memo in memos"
          :key="memo.id"
          :id="memo.id"
          :content="memo.content"
          :created-at="memo.created_at"
          :is-favorite="memo.is_favorite"
          :color="memo.color"
          @trashed="emit('trashed', $event)"
          @edited="(id, content) => emit('edited', id, content)"
          @favorited="(id, isFavorite) => emit('favorited', id, isFavorite)"
        />
      </TransitionGroup>
    </div>

    <div class="chalkboard-shelf h-6 flex items-center justify-center gap-2 px-4">
      <div class="eraser w-12 h-4"></div>
      <div class="eraser w-8 h-4"></div>
    </div>
  </div>
</template>
