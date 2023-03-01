<template>
  <div>
    <div id="editor"></div>
    <button @click="handleSave">Create</button>
  </div>
</template>
<script setup>
import EditorJS from '@editorjs/editorjs';
import Header from "@editorjs/header";
import Quote from '@editorjs/quote';
import Warning from '@editorjs/warning';
import AlignmentTuneTool from 'editorjs-text-alignment-blocktune';
import { ref, reactive, computed, onMounted } from 'vue';
import axios from 'axios';


const editor = new EditorJS({
      holder: 'editor',
      minHeight : 0,
      tools: {
        header: {
          class: Header,
          tunes: ['alignmentTuneTool'],
          config: {
            placeholder: 'Enter a header',
            levels: [2,3,4],
            defaultAlignment: 'left'
          }
        },
        quote: {
          class: Quote,
          tunes: ['TalignmentTuneTool'],
          inlineToolbar: true,
          config: {
            quotePlaceholder: 'Enter a quote',
            captionPlaceholder: 'Quote\'s author'
          }
        },
        warning: {
          class: Warning,
          tunes: ['alignmentTuneTool'],
          inlineToolbar: true,
          config: {
            titlePlaceholder: 'Warning Title',
            messagePlaceholder: 'Warning Message',
          },
        },
        alignmentTuneTool: {
          class: AlignmentTuneTool
        },
      },
    });

//reactiveで、エディタ内の入力情報を監視
const outputData = reactive({ blocks: [], time: null });
const title = ref('');

const handleSave = async () => {
  try {
    outputData.value = await editor.save();
    const response = await axios.post('/posts/store', {
    content: JSON.stringify(outputData.value),
    title: document.querySelector('input[name="title"]').value,
        }, 
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