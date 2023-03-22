<template>
    <table class="table table-striped">
        <!-- <div>{{ this.data }}</div> -->
        <thead>
            <tr>
                <th scope="col" v-for="key, index in data.keys" :key="index">{{ key }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in data.values">
                <td v-for="v, index in value" :key="index">{{ v }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            // data: {}
        }
    },
    mounted() {
        // const formData = new FormData();
        // // formData.append('image', file);

        // const options = {
        //     method: 'GET',
        //     // body: formData,
        //     // If you add this, upload won't work
        //     // headers: {
        //     //   'Content-Type': 'multipart/form-data',
        //     // }
        // };
        // const url = window.location.origin + '/api/admin';
        // fetch(url, options)
        //     .then(response => {
        //         return response.json();
        //     }).then(result => {
        //         console.log(result);
        //     });
    }
}
</script>
