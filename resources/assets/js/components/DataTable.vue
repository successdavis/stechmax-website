<template>
    <div>
        <div class="grid-x grid-padding-x grid-container">
            <div class="small-2 medium-2">
                <label>Per Page
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
                <label>Sort by:
                    <select>
                        <option  value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="New">Newly Registered</option>
                        <option selected value="all">None</option>
                    </select>
                </label>
            </div>
            <portal-target name="datatable-buttons"></portal-target>

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
                <td v-text="data.f_name">
                </td>
                <td v-text="data.l_name"></td>
                <td v-text="data.gender"></td>
                <td v-text="data.phone"></td>
                <td ><view-user :modal="data.id + 'a'" :selectedUser="data" @userUpdated="fetch"></view-user></td>
            </tr>
        </tbody>
    </table>
        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
    </div>

</template>

<script>
    import collection from '../mixins/collection';

    export  default {

        props: ['headers', 'setup'],

        data() {
            return {
                dataSet: false,
                items: [

                ],
                pagination: {
                    meta: { to: 1, from: 1 }
                },
                offset: this.setup.offset,
                currentPage: this.setup.currentPage,
                perPage: this.setup.perPage,
                sortedColumn: this.setup.sortedColumn,
                order: this.setup.order
            };
        },

        created() {
            this.fetch();
            // Event.$on('newUserCreated', (user) => this.items.unshift(user));
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
