<template>
<div id="editor2"></div>
</template>
<script>
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';

export default {
  mounted() {
    const editor = new EditorJS({
      holder: 'editor2',
      tools: {
        header: Header,
      },
    });
  }
}
</script>