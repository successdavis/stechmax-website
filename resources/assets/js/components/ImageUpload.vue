<template>
    <div>
        <label for="avater" class="button small">Upload File</label>
        <input type="file" id="avater" class="show-for-sr" accept="image/*" @change="onChange">
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
                this.persist(avatar);
            }
        }
    }
</script>
