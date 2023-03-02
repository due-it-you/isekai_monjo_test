<template>
    <div>
        <div id="editor"></div>
        <button @click="update">更新</button>
    </div>
</template>
<script setup>
    import EditorJS from '@editorjs/editorjs';
    import Header from "@editorjs/header";
    import Quote from '@editorjs/quote';
    import BreakLine from 'editorjs-break-line';
    import Warning from '@editorjs/warning';
    import AlignmentTuneTool from 'editorjs-text-alignment-blocktune';
    import { defineProps, ref, reactive, onMounted } from "vue";
    import axios from 'axios';
    
    //controller@edit => edit.blade.phpから渡された投稿のデータをオブジェクト形式で受け取る
    const props = defineProps({
        post: Object
    });

    //EditorJSの初期化
    const editor = new EditorJS({
            holder: 'editor',
            minHeight: 0,
            tools: {
            header: {
                class: Header,
                tunes: ['alignmentTuneTool'],
                config: {
                placeholder: 'Enter a header',
                levels: [2, 3, 4],
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
            breakLine: {
                class: BreakLine,
                inlineToolbar: true,
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
            data: props.post.content
        });

    //Editor内の情報をreactiveで配列形式で監視
    const outputData = reactive({ blocks: [], time: null });

    //更新する内容をController@updarteに渡す処理
    const update = async () => {
        try {
        outputData.value = await editor.save();
        const response = await axios.post('/posts/update', {
            //JSON文字列でエディタのデータを渡す
            content: JSON.stringify(outputData.value),
            //投稿のidも渡す
            postId: props.post['id'],
        });

        console.log('response:', response);

        //リダイレクト処理
        if (response.status === 200) {
            window.location.href = '/home';
        }
        } catch (error) {
        console.error('Update Error:', error);
        };
    };

</script>