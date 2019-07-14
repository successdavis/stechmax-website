<template>
    <div>
        <data-table :headers="headers" :setup="setup"></data-table>

        <!-- Include here all components you want to appear on the table head -->
        <portal to="datatable-buttons">
            <!-- <div class="small-3 medium-2">
                    <new-user :modal="'newUserRegModal'" class="medium button" style="margin-left: 1em; margin-top: 1.66em;"></new-user>
                </div> -->
        </portal>
    </div>

</template>

<script>
    import collection from '../mixins/collection';

    export  default {
        data() {
            return {
                dataSet: false,
                
                headers: [
                    {name: 'Title', sort: 'title'},
                    {name: 'Duration'},
                    {name: 'Published'},
                    {name: 'Action'},
                ],
                setup: {
                    offset: 4,
                    currentPage: 1,
                    perPage: 25,
                    sortedColumn: 'title',
                    order: 'asc'  
                },
                actions: [
                    // {url: '<view-></view-user>', Label: 'Manage'}
                ],
            };
        },

        created() {
            // this.fetch();
            Event.$on('newUserCreated', (user) => this.items.unshift(user));
        },
    }
</script>

<style scoped>

</style>
