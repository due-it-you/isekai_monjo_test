<template>
<!-- <form @submit.prevent="addTag"> -->
        <input type="text" v-model="newTag">
<!-- <div v-for="tag in tags" :key="tag.id">
    {{ tag.id }}
</div> -->
<p><button @click="addTag">Add Tag</button></p>
<!-- </form> -->
</template>

<script>
import axios from 'axios';

    export default {
        data() {
            return {
                newTag: '',
                tags: []
            }
        },
        methods: {
            addTag() {
                if(!this.newTag) {
                    return;
                    }
            
                axios.post('/tags', {tag_label: this.newTag} )
                    .then(response => {
                        this.tags.push(response.data);
                        this.newTag = '';
                    })
                    .catch(error => {
                        console.log(error);
                    });
                    }

            
            }
        }

</script>

<style>
    .inline-block {
        display: inline-block;
    }

    .bg-gray-200 {
        background-color: black;
    }

    .rounded-full {
        border-radius: 50%;
    }

    .px-3 {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .py-1 {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
    }

    .text-sm {
        font-size: 0.875rem;
    }

    .font-semibold {
        font-weight: 600;
    }

    .text-gray-700 {
        color: #4a5568;
    }

    .mr-2 {
        margin-right: 0.5rem;
    }
</style>