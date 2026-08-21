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
  isDone: boolean;
  color: string;
}>();

const emit = defineEmits<{
  trashed: [id: number];
  edited: [id: number, content: string];
  favorited: [id: number, isFavorite: boolean];
  toggledDone: [id: number, isDone: boolean];
}>();

const chalkColors: Record<string, string> = {
  orange: '#f5c99b',
  pink: '#f5b8c4',
  yellow: '#f5e9a8',
  sky: '#b8dff5',
};

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

const toggleDone = () => {
  emit('toggledDone', props.id, !props.isDone);
};
</script>

<template>
  <div class="p-3">
    <div class="flex justify-between items-start gap-4">
      <div class="flex gap-3 flex-1">
        <button
          @click="toggleDone"
          class="shrink-0 mt-1 w-5 h-5 border-2 rounded flex items-center justify-center transition-colors"
          :class="isDone ? 'border-white bg-white/20' : 'border-white/50'"
          title="完了"
        >
          <span v-if="isDone" class="text-white text-xs">✓</span>
        </button>

        <button
          @click="toggleFavorite"
          class="shrink-0 p-1 rounded-lg transition-colors"
          :class="isFavorite ? 'text-yellow-300' : 'text-white/40 hover:text-yellow-300'"
          title="お気に入り"
        >
          <StarSvg :filled="isFavorite" />
        </button>

        <div class="flex-1">
          <textarea
            v-if="isEditing"
            v-model="editContent"
            rows="3"
            class="w-full bg-white/10 border border-white/30 rounded-lg p-2 outline-none resize-none text-white"
            @keydown.enter.exact="handleEnter"
            @keydown.esc="cancel"
          />
          <p
            v-else
            class="chalk-text whitespace-pre-wrap"
            :class="isDone ? 'line-through opacity-50' : ''"
            :style="{ color: chalkColors[color] || chalkColors.orange }"
          >
            {{ content }}
          </p>

          <p class="text-xs text-white/40 mt-2">{{ createdAt }}</p>
        </div>
      </div>

      <div v-if="!isEditing" class="flex gap-1 opacity-0 group-hover:opacity-100">
        <button
          @click="startEdit"
          class="p-2 text-white/60 hover:text-primary-300 rounded-lg transition-colors"
          title="編集"
        >
          <EditSvg />
        </button>
        <button
          @click="emit('trashed', props.id)"
          class="p-2 text-white/60 hover:text-red-300 rounded-lg transition-colors"
          title="削除"
        >
          <TrashSvg />
        </button>
      </div>
    </div>
  </div>
</template>
