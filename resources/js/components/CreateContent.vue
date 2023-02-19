<template>
<div id="editor"></div>
</template>
<script>
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';

export default {
  mounted() {
    const editor = new EditorJS({
      holder: 'editor',
      minHeight : '300px',
      tools: {
        header: Header,
      },
    });
  }
}
</script>