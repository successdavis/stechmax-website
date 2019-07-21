<template>
    <div>
        <data-table :headers="headers" :setup="setup"></data-table>
        <portal to="datatable-buttons">
            <div class="small-3 medium-2">
                    <new-user :modal="'newUserRegModal'" class="medium button" style="margin-left: 1em; margin-top: 1.66em;"></new-user>
                </div>
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
                    {name: 'First Name', sort: 'f_name'},
                    {name: 'Last Name', sort: 'l_name'},
                    {name: 'Gender'},
                    {name: 'Phone No'},
                    {name: 'Action'}
                ],
                setup: {
                    offset: 4,
                    currentPage: 1,
                    perPage: 25,
                    sortedColumn: 'f_name',
                    order: 'asc'  
                }
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
