<template>
    <div id="editor"></div>
    <button @click="updatePost">更新</button>
</template>
<script setup>
    import EditorJS from '@editorjs/editorjs';
    import Header from "@editorjs/header";
    import Quote from '@editorjs/quote';
    import Warning from '@editorjs/warning';
    import AlignmentTuneTool from 'editorjs-text-alignment-blocktune';
    import { ref, reactive, computed, onMounted } from 'vue';
    import axios from 'axios';
    
    const props = defineProps({
        post: Object
    });

    let postData = {};

    onMounted(() => {
        //blade側から送られた$postから、contentの取得
        const postData = props.post.content;

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
            data: postData
        });
    });

</script>