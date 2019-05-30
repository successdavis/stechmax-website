<template>
    <div>
        <div class="grid-x grid-padding-x grid-container">
            <div class="small-2 medium-1">
                <label>No Per Page
                    <select v-model="perPage" @change="fetch">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="all">All</option>
                    </select>
                </label>
            </div>
            <span style="margin-right: 1em"></span>
            <div class="small-3 medium-2">
                <label>Sort by State
                    <select>
                        <option  value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="New">Newly Registered</option>
                        <option selected value="all">None</option>
                    </select>
                </label>
            </div>
            <div class="small-3 medium-2">
                <new-user :modal="'newUserRegModal'" class="medium button" style="margin-left: 1em; margin-top: 1.66em;"></new-user>
            </div>

        </div>

        <table>

            <thead>
            <tr>
                <td v-for="t_head in headers">
                    {{t_head.name}}
                    <a v-if="t_head.name === 'Name'" style="" @click.prevent="sortByColumn(t_head.sort)">
                            <i v-if="order === 'asc' " class="fas fa-sort-alpha-up"></i>
                            <i v-else class="fas fa-sort-alpha-down"></i>
                    </a>
                </td>
            </tr>
        </thead>

        <tbody>
            <tr v-for="data in items" :key="data.id">
                <td v-text="data.f_name + ' ' + data.m_name + ' ' + data.l_name ">
                </td>
                <td v-text="data.gender"></td>
                <td v-text="data.dob"></td>
                <td v-text="data.phone"></td>
                <td ><view-user :modal="data.email"></view-user></td>
            </tr>
        </tbody>
    </table>
        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
    </div>

</template>

<script>
    import NewReply from './NewReply.vue';
    import collection from '../mixins/collection';

    export  default {

        data() {
            return {
                dataSet: false,
                items: [

                ],
                pagination: {
                    meta: { to: 1, from: 1 }
                },
                headers: [
                    {name: 'Name', sort: 'f_name'},
                    {name: 'Gender'},
                    {name: 'Date of Birth'},
                    {name: 'Phone No'},
                    {name: 'Action'}
                ],
                offset: 4,
                currentPage: 1,
                perPage: 50,
                sortedColumn: 'f_name',
                order: 'asc'
            };
        },

        created() {
            this.fetch();
            Event.$on('newUserCreated', (user) => this.items.unshift(user));
        },

        methods: {
            fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },

            url(page) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }
                return `${location.pathname}/datatable?page=${page}&column=${this.sortedColumn}&order=${this.order}&per_page=${this.perPage}`;
            },

            sortByColumn(column) {
                if (column === this.sortedColumn) {
                    this.order = (this.order === 'asc') ? 'desc' : 'asc'
                } else {
                    this.sortedColumn = column;
                    this.order = 'asc'
                }

                this.fetch()
            },

            refresh({data}) {
                this.dataSet = {
                    next_page_url : data.links.next,
                    current_page: data.meta.current_page,
                    per_page: data.meta.per_page,
                    total: data.meta.total,
                    prev_page_url: data.links.prev
                };
                this.items = data.data;
                this.pagination = data;

                window.scrollTo(0, 0);
            },
        }
    }
</script>

<style scoped>

</style>
