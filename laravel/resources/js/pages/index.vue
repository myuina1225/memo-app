<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import Header from "../components/Header.vue";
import CategoryManager from "../components/CategoryManager.vue";
import MemoForm from "../components/MemoForm.vue";
import MemoList from "../components/MemoList.vue";

const memos = ref([]);
const categories = ref<{ id: number; name: string; color: string }[]>([]);
const searchQuery = ref('');

const memosWithCategory = computed(() => {
  return memos.value.map((memo) => {
    const category = categories.value.find((c) => c.id === memo.category_id);
    return {
      ...memo,
      category_name: category ? category.name : null,
      category_color: category ? category.color : null,
    };
  });
});

const sortedMemos = computed(() => {
  return [...memosWithCategory.value].sort((a, b) => b.is_favorite - a.is_favorite);
});

const filteredMemos = computed(() => {
  return sortedMemos.value.filter((memo) =>
    memo.content.includes(searchQuery.value)
  );
});

const fetchMemos = async () => {
  const response = await fetch('/api/memos');
  memos.value = await response.json();
};

const fetchCategories = async () => {
  const response = await fetch('/api/categories');
  categories.value = await response.json();
};

const deleteMemo = async (id: number) => {
  await fetch(`/api/memos/${id}`, { method: 'DELETE' });
  fetchMemos();
};

const editMemo = async (id: number, content: string) => {
  await fetch(`/api/memos/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ content }),
  });
  fetchMemos();
};

const favoriteMemo = async (id: number, isFavorite: boolean) => {
  await fetch(`/api/memos/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ is_favorite: isFavorite }),
  });
  fetchMemos();
};

const toggleDoneMemo = async (id: number, isDone: boolean) => {
  await fetch(`/api/memos/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ is_done: isDone }),
  });
  fetchMemos();
};

onMounted(() => {
  fetchMemos();
  fetchCategories();
});
</script>

<template>
  <Header />
  <div class="max-w-2xl mx-auto px-6 py-8">
    <CategoryManager @changed="fetchCategories" />
    <MemoForm :categories="categories" @saved="fetchMemos" />
    <MemoList
      :memos="filteredMemos"
      v-model:search-query="searchQuery"
      @trashed="deleteMemo"
      @edited="editMemo"
      @favorited="favoriteMemo"
      @toggled-done="toggleDoneMemo"
    />
  </div>
</template>