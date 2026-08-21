<script setup lang="ts">
import { ref, onMounted } from 'vue';

const emit = defineEmits<{
  changed: [];
}>();

const categories = ref<{ id: number; name: string; color: string }[]>([]);
const newName = ref('');
const newColor = ref('orange');

const colorOptions = [
  { name: 'orange', class: 'bg-orange-300' },
  { name: 'pink', class: 'bg-pink-300' },
  { name: 'yellow', class: 'bg-yellow-300' },
  { name: 'sky', class: 'bg-sky-300' },
];

const categoryColorClasses: Record<string, string> = {
  orange: 'bg-orange-100 text-orange-700',
  pink: 'bg-pink-100 text-pink-700',
  yellow: 'bg-yellow-100 text-yellow-700',
  sky: 'bg-sky-100 text-sky-700',
};

const fetchCategories = async () => {
  const response = await fetch('/api/categories');
  categories.value = await response.json();
};

const addCategory = async () => {
  if (!newName.value) return;

  const response = await fetch('/api/categories', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ name: newName.value, color: newColor.value }),
  });

  if (response.ok) {
    newName.value = '';
    await fetchCategories();
    emit('changed');
  }
};

const deleteCategory = async (id: number) => {
  await fetch(`/api/categories/${id}`, { method: 'DELETE' });
  await fetchCategories();
  emit('changed');
};

onMounted(fetchCategories);
</script>

<template>
  <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-8">
    <h2 class="text-sm font-semibold text-gray-600 mb-3">カテゴリ管理</h2>

    <div class="flex flex-wrap gap-2 mb-3">
      <span
        v-for="category in categories"
        :key="category.id"
        class="flex items-center gap-1 text-xs px-2 py-1 rounded-full"
        :class="categoryColorClasses[category.color] || categoryColorClasses.orange"
      >
        {{ category.name }}
        <button @click="deleteCategory(category.id)" class="ml-1 hover:text-red-500">×</button>
      </span>
    </div>

    <div v-if="categories.length < 4" class="flex items-center gap-2">
      <input
        v-model="newName"
        type="text"
        placeholder="カテゴリ名"
        class="flex-1 px-2 py-1 text-sm border border-gray-200 rounded-lg outline-none"
      />
      <div class="flex gap-1">
        <button
          v-for="color in colorOptions"
          :key="color.name"
          @click="newColor = color.name"
          class="w-5 h-5 rounded-full"
          :class="[color.class, newColor === color.name ? 'ring-2 ring-offset-1 ring-gray-400' : '']"
        />
      </div>
      <button
        @click="addCategory"
        :disabled="!newName"
        class="text-sm px-3 py-1 bg-primary-500 text-white rounded-lg disabled:opacity-40"
      >
        追加
      </button>
    </div>
    <p v-else class="text-xs text-gray-400">カテゴリは最大4個までです</p>
  </div>
</template>
