<script>
    export default {
        props: ['user'],
        data () {
            return {
                isLoading: false,
                dataSet: false,
                invoices: {},
                
                headers: [
                    {name: 'Date', sort: 'created_at'},
                    {name: 'InvoiceNo', sort: 'invoiceno'},
                    {name: 'BilledTo'},
                    {name: 'Amount'},
                    {name: 'Status'},
                ],
                offset: 4,
                currentPage: 1,
                perPage: 25,
                sortedColumn: 'created_at',
                order: 'desc'  
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