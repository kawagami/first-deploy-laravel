<template>
    <div class="container">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" :class="{ active: chatgptShow }" href="#" v-on:click="showChatgpt">ChatGPT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{ active: LineBotShow }" href="#" v-on:click="showLineBot">Line</a>
            </li>
        </ul>
        <LineBotComponent v-if="LineBotShow" :data="LineBotData" />
        <LineBotComponent v-if="chatgptShow" :data="chatgptData" />
    </div>
</template>

<script>

import LineBotComponent from './admin/LineBotComponent.vue';

export default {
    components: { LineBotComponent },
    data() {
        return {
            LineBotShow: false,
            LineBotData: {},
            chatgptShow: false,
            chatgptData: {}
        }
    },
    methods: {
        showChatgpt() {
            this.LineBotShow = false;
            this.chatgptShow = true;
        },
        showLineBot() {
            this.LineBotShow = true;
            this.chatgptShow = false;
        }
    },
    created() {

        const formData = new FormData();
        // formData.append('image', file);

        const options = {
            method: 'GET',
            // body: formData,
            // If you add this, upload won't work
            // headers: {
            //   'Content-Type': 'multipart/form-data',
            // }
        };
        const url = window.location.origin + '/api/admin';
        fetch(url, options)
            .then(response => {
                return response.json();
            }).then(result => {
                // console.log(result);
                this.LineBotData = result.line_bot;
                this.chatgptData = result.chatgpt;
            });
    }
}
</script>
