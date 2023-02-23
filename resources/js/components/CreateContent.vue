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
import axios from 'axios';

const editor = new EditorJS({
      holder: 'editor',
      minHeight : 0,
      tools: {
        header: Header,
      },
    });

const outputData = reactive({ blocks: [], time: null });
const title = ref('');

const handleSave = async () => {
  try {
    outputData.value = await editor.save();
    console.log('Article data: ', outputData.value);
    const response = await axios.post('/posts/store', {
  content: JSON.stringify(outputData.value),
  title: document.querySelector('input[name="title"]').value,
}, {
  headers: {
    'X-CSRF-TOKEN': window.csrfToken,
  }
});

    console.log('reponse:', response);

    //もしレスポンスのHTTPステータスが200(成功)の時、home画面に遷移
    if(response.status === 200) {
      window.location.href = '/home';
    }

  } catch (error) {
    console.error('Saving failed: ', error);
  }
}
</script>