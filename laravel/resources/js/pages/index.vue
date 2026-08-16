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

onMounted(fetchMemos);
</script>

<template>
  <Header />
  <div class="max-w-2xl mx-auto px-6 py-8">
    <MemoForm @saved="fetchMemos" />
    <MemoList :memos="memos" />
  </div>
</template>