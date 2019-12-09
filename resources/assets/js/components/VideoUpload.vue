<template>
    <div>
        <label for="video" class="button small">Update Video</label>
        <input type="file" id="video" class="show-for-sr" accept="video/*" @change="onChange">
    </div>
</template>

<script>
    export default {
        methods: {
            onChange(e) {
                if(! e.target.files.length) return;
                let file = e.target.files[0];

                let reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = e => {
                    let src = e.target.result;

                    this.$emit('loaded', {src, file});
                };

                // Persis to the server
                this.persist(video);
            }
        }
    }
</script>
