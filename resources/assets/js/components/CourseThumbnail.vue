<template>
    <div class="mt-2"> 
        <p class="grid-container">Course Image</p>     
        <div class="grid-x grid-container grid-padding-x">
            <div class="medium-8 thumbnail">
                <img :src="thumbnail" class="mb-2">
                <ul>
                    <li v-for="error in errors.thumbnail" v-text="error"></li>
                </ul>     
            </div>
            <div class="medium-4 grid-container">
                <p>Important guidelines: </p>
                750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.
                <form method="POST" enctype="multipart/form-data">
                    <input type="file" accept="image/*" @change="onChange" name="thumbnail">

                </form>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['data','path'],

    data () {
        return {
            errors: [],
            thumbnail: this.data.thumbnail_path,
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
            this.errors = [];
        },

        persist: function (thumbnail) {
            let data = new FormData();

            data.append('thumbnail', thumbnail);
            axios.post(`/api${this.path}`, data)
                .then(() => {
                    flash('Thumbnail upload successful')
                })
                .catch(error => {
                    flash('This image does not meet the requirement')
                    this.errors = (error.response.data.errors);
                });
        }
    }
}

</script>
