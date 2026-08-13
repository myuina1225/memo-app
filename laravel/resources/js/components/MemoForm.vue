<script setup lang="ts">
import { ref } from 'vue';
import PlusSvg from './svgs/PlusSvg.vue';
import TextareaForm from './TextareaForm.vue';
import Button from './Button.vue';

const newMemo = ref('');
</script>

<template>
  <div class="bg-white rounded-xl shadow-lg border border-orange-100 p-6 mb-8">
    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
      <PlusSvg />
      新しいメモ
    </h2>

    <div class="space-y-4">
      <TextareaForm v-model="newMemo" />

      <Button :disabled="!newMemo" />
    </div>
  </div>
</template>
