<script setup lang="ts">
import { ref } from 'vue';
import PlusSvg from './svgs/PlusSvg.vue';
import TextareaForm from './TextareaForm.vue';
import Button from './Button.vue';

defineProps<{
  categories: { id: number; name: string; color: string }[];
}>();

const emit = defineEmits<{
  saved: [];
}>();

const newMemo = ref('');
const selectedCategoryId = ref<number | null>(null);

const addMemo = async () => {
  if (!newMemo.value) return;

  await fetch('/api/memos', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ content: newMemo.value, category_id: selectedCategoryId.value }),
  });

  newMemo.value = '';
  emit('saved');
};

const handleEnter = (event: KeyboardEvent) => {
  if (event.isComposing) return;
  addMemo();
};
</script>

<template>
  <div class="bg-white rounded-xl shadow-lg border border-orange-100 p-6 mb-8">
    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
      <PlusSvg />
      新しいタスク
    </h2>

    <div class="space-y-4">
      <TextareaForm v-model="newMemo" @keydown.enter.exact="handleEnter" />

      <div v-if="categories.length > 0" class="flex flex-wrap gap-2">
        <button
          @click="selectedCategoryId = null"
          class="text-xs px-2 py-1 rounded-full border"
          :class="selectedCategoryId === null ? 'border-gray-400 bg-gray-100' : 'border-gray-200 text-gray-500'"
        >
          なし
        </button>
        <button
          v-for="category in categories"
          :key="category.id"
          @click="selectedCategoryId = category.id"
          class="text-xs px-2 py-1 rounded-full border"
          :class="selectedCategoryId === category.id ? 'border-primary-400 bg-primary-50' : 'border-gray-200 text-gray-500'"
        >
          {{ category.name }}
        </button>
      </div>

      <Button :disabled="!newMemo" @click="addMemo" />
    </div>
  </div>
</template>