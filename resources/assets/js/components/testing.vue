<template>
    <div>
        <a @click="$modal.show('test')">BUTTONS</a>

        <modal name="test" height="auto" draggable=".window-header">
            <div class="window-header">DRAG ME HERE</div>
        </modal>
    </div>
</template>

<script>
    export default {

    }
</script>