<template>
    <div>
        <button @click="$modal.show(modal)" class="small button">View User</button>
        <modal :name="modal" height="auto" draggable=".window-header">
            <div class="grid-x grid-padding-x grid-container align-center">
                <div class="medium-6 grid-x align-right grid-container">
                    <img :src="selectedUser.avatar_path" class="thumbnail&#45;&#45;medium mt-2">
                    
                </div>
            </div>
        </modal>
    </div>
    
</template>

<script>
    export default {
        props: ['modal', 'selectedUser'],
        name: "ViewUser"
    }
</script>

<style scoped>

</style>
