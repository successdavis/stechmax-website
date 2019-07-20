<template>
    <div class="container">
        <form @submit.prevent="addPost">
            <input v-model="title" type="text" placeholder="Inpute your name here">
            <button type="submit" class="small button">submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                title: '',
            }
        },

        methods: {
            addPost () {
              axios.post('/testing', {title: this.title})
            }
        }
    }
</script>
