<script setup lang="ts">
import { ref } from 'vue';
import PlusSvg from './svgs/PlusSvg.vue';
import TextareaForm from './TextareaForm.vue';
import Button from './Button.vue';

const emit = defineEmits<{
  saved: [];
}>();

const colors = [
  { name: 'orange', class: 'bg-orange-300' },
  { name: 'pink', class: 'bg-pink-300' },
  { name: 'yellow', class: 'bg-yellow-300' },
  { name: 'sky', class: 'bg-sky-300' },
];

const newMemo = ref('');
const selectedColor = ref('orange');

const addMemo = async () => {
  if (!newMemo.value) return;

  await fetch('/api/memos', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ content: newMemo.value, color: selectedColor.value }),
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

      <div class="flex gap-2">
        <button
          v-for="color in colors"
          :key="color.name"
          @click="selectedColor = color.name"
          class="w-6 h-6 rounded-full transition-all"
          :class="[color.class, selectedColor === color.name ? 'ring-2 ring-offset-2 ring-gray-400' : '']"
          :title="color.name"
        />
      </div>

      <Button :disabled="!newMemo" @click="addMemo" />
    </div>
  </div>
</template>
