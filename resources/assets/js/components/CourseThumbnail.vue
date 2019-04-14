<template>
    <div>
        <form method="POST" enctype="multipart/form-data">

            <input type="file" accept="image/*" @change="onChange" name="thumbnail">

            <button type="submit">Upload Thumbnail</button>

        </form>
        <img :src="thumbnail" class="thumbnail">
    </div>
</template>

<script>

export default {
    props: ['data'],

    data () {
        return {
            thumbnail: '',
        };
    },

    methods: {
        onChange(e) {
            if (! e.target.files.length) return;

            let thumbnail = e.target.files[0];

            let reader = new FileReader();

            reader.readAsDataURL(thumbnail);

            reader.onload = e => {
                console.log(e);
                this.thumbnail = e.target.result;
            };

            this.persist(thumbnail);
        },

        persist: function (thumbnail) {
            let data = new FormData();

            data.append('thumbnail', thumbnail);
            axios.post(`/api${this.data.path}`, data)
                .then(() => flash('Thumbnail upload successful'));
        }
    }
}

</script>