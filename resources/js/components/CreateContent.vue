<template>
<div>
  <div id="editor"></div>
  <button @click="handleSave">Create</button>
  <!-- <pre>{{ JSON.stringify(outputData.value, null, 2) }}</pre> -->
</div>
</template>
<script setup>
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import { ref, reactive, computed, onMounted } from 'vue';

const editor = new EditorJS({
      holder: 'editor',
      minHeight : 0,
      tools: {
        header: Header,
      },
    });

const outputData = reactive({ blocks: [], time: null });

const handleSave = async () => {
  try {
    outputData.value = await editor.save()
    console.log('Article data: ', outputData.value)
  } catch (error) {
    console.error('Saving failed: ', error)
  }
}
// export default {
//   mounted() {
//     const editor = new EditorJS({
//       holder: 'editor',
//       minHeight : 0,
//       tools: {
//         header: Header,
//       },
//     });
//   }
// }
</script>