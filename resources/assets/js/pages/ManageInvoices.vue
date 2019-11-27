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
                        <option  value="completed='true'">Completed</option>
                        <option value="completed='false'">Due Invoices</option>
                        <option value="created_at">Date</option>
                        <option value="New">InvoiceNo</option>
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
            <tr v-for="data in invoices" :key="data.id">
                <td v-text="data.date">
                </td>
                <td v-text="data.invoiceNo"></td>
                <td v-text="data.amount"></td>
                <td v-text="data.status"></td>
                <td ><invoice-payments :modal="data.id + 'a'" :selectedInvoice="data"></invoice-payments></td>
            </tr>
        </tbody>
    </table>
        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
    </div>

</template>

<script>
    export default {
        props: ['user'],
        data () {
            return {
                dataSet: false,
                invoices: {},
                
                headers: [
                    {name: 'Date', sort: 'created_at'},
                    {name: 'InvoiceNo', sort: 'invoiceno'},
                    {name: 'Amount'},
                    {name: 'Status'},
                    {name: 'Action'}
                ],
                offset: 4,
                currentPage: 1,
                perPage: 25,
                sortedColumn: 'created_at',
                order: 'asc'  
            };
        },

        created () {
            this.fetch();
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
                this.invoices = data.data;
                this.pagination = data;

                window.scrollTo(0, 0);
            },
        }
    }
</script>
</script>