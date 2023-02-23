<template>
    <div>
        <input type="text" id="suggest" v-model="SearchTerm" placeholder="Type here...">
    </div>
</template>
<script>
    import {ref} from 'vue'

    export default {
        setup() {
            let SuggestTag = ref('')

            return {
                SuggestTag
            }
        }
    }
</script>
