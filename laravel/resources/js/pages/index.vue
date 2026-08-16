<script setup lang="ts">
import Header from "../components/Header.vue";
import MemoForm from "../components/MemoForm.vue";
import MemoList from "../components/MemoList.vue";
</script>

<template>
  <Header />
  <div class="max-w-2xl mx-auto px-6 py-8">
    <MemoForm />
    <MemoList />
  </div>
</template>
