<script setup lang="ts">
import { ref } from 'vue';
import EditSvg from './svgs/EditSvg.vue';
import TrashSvg from './svgs/TrashSvg.vue';
import StarSvg from './svgs/StarSvg.vue';

const props = defineProps<{
  id: number;
  content: string;
  createdAt: string;
  isFavorite: boolean;
}>();

const emit = defineEmits<{
  trashed: [id: number];
  edited: [id: number, content: string];
  favorited: [id: number, isFavorite: boolean];
}>();

const isEditing = ref(false);
const editContent = ref('');

const startEdit = () => {
  editContent.value = props.content;
  isEditing.value = true;
};

const save = () => {
  if (!editContent.value) return;
  emit('edited', props.id, editContent.value);
  isEditing.value = false;
};

const cancel = () => {
  isEditing.value = false;
};

const handleEnter = (event: KeyboardEvent) => {
  if (event.isComposing) return;
  save();
};

const toggleFavorite = () => {
  emit('favorited', props.id, !props.isFavorite);
};
</script>

<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5 group">
    <div class="flex justify-between items-start gap-4">
      <div class="flex gap-3 flex-1">
        <button
          @click="toggleFavorite"
          class="shrink-0 p-1 rounded-lg transition-colors"
          :class="isFavorite ? 'text-yellow-500' : 'text-gray-300 hover:text-yellow-500'"
          title="お気に入り"
        >
          <StarSvg :filled="isFavorite" />
        </button>

        <div class="flex-1">
          <textarea
            v-if="isEditing"
            v-model="editContent"
            rows="3"
            class="w-full border border-primary-400 rounded-lg p-2 outline-none resize-none"
            @keydown.enter.exact="handleEnter"
            @keydown.esc="cancel"
          />
          <p v-else class="text-gray-800 whitespace-pre-wrap">{{ content }}</p>

          <p class="text-xs text-gray-400 mt-3">{{ createdAt }}</p>
        </div>
      </div>

      <div v-if="!isEditing" class="flex gap-1 opacity-0 group-hover:opacity-100">
        <button
          @click="startEdit"
          class="p-2 text-gray-400 hover:text-primary-500 hover:bg-primary-50 rounded-lg transition-colors"
          title="編集"
        >
          <EditSvg />
        </button>
        <button
          @click="emit('trashed', props.id)"
          class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors"
          title="削除"
        >
          <TrashSvg />
        </button>
      </div>
    </div>
  </div>
</template>