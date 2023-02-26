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
import Quote from '@editorjs/quote';
import { ref, reactive, computed, onMounted } from 'vue';
import axios from 'axios';

const editor = new EditorJS({
      holder: 'editor',
      minHeight : 0,
      tools: {
        header: {
          class: Header,
          config: {
            placeholder: 'Enter a header',
            levels: [2,3,4]
          }
        },
        quote: {
          class: Quote,
          inlineToolbar: true,
          config: {
            quotePlaceholder: 'Enter a quote',
            captionPlaceholder: 'Quote\'s author'
          }
        },
      }
    });

//reactiveで、エディタ内の入力情報を監視
const outputData = reactive({ blocks: [], time: null });
const title = ref('');

const handleSave = async () => {
  try {
    outputData.value = await editor.save();
    console.log('Article data: ', outputData.value);
    const response = await axios.post('/posts/store', {
  content: JSON.stringify(outputData.value),
  title: document.querySelector('input[name="title"]').value,
}, 
//Laravelのデフォルト設定にあるX-XSRF-TOKENを利用するものとする
// {
//   headers: {
//     'X-CSRF-TOKEN': window.csrfToken,
//             }
//           }
          );

    //開発ツールのコンソール画面にてレスポンス結果を表示
    console.log('reponse:', response);

    //もしレスポンスのHTTPステータスが200(成功)の時、home画面に遷移
    if(response.status === 200) {
      window.location.href = '/home';
    }

  } catch (error) {
    //開発ツールのコンソール画面にてエラー結果を表示
    console.error('Saving failed: ', error);

    }

  }
</script>