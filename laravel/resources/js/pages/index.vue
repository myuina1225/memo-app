<script setup lang="ts">
import { ref, onMounted } from 'vue';
import Header from "../components/Header.vue";
import MemoForm from "../components/MemoForm.vue";
import MemoList from "../components/MemoList.vue";

const memos = ref([]);

const fetchMemos = async () => {
  const response = await fetch('/api/memos');
  memos.value = await response.json();
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

onMounted(fetchMemos);
</script>

<template>
  <Header />
  <div class="max-w-2xl mx-auto px-6 py-8">
    <MemoForm @saved="fetchMemos" />
    <MemoList :memos="memos" @trashed="deleteMemo" @edited="editMemo" />
  </div>
</template>
