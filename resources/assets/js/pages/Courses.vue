<script>
    import collection from '../mixins/collection';

    export  default {
        data() {
            return {
                dataSet: false,
                page: 1,
                total: '',
                search: '',
                isLoading: '',
                items: [

                ],
                pagination: {
                    meta: { to: 1, from: 1 }
                },
                status: '',
                type: '',
                search: '',
                currentPage: 1,
                perPage: 25,
                sortedColumn: 'title',
                order: 'asc',
                subjects: [],
                subject: 'graphics',
            };
        },

        created() {
            axios.get('/api/subjects').then(response => 
                this.subjects = response.data
            );

            this.fetch();
            // Event.$on('newUserCreated', (user) => this.items.unshift(user));
        },

        methods: {
              fetch($state) {
                axios.get(`${location.pathname}/datatable`, {
                    params: {
                        page: this.page,
                        column: this.sortedColumn,
                        order: this.order,
                        per_page: this.per_page,
                        published: this.status,
                        subject: this.subject,
                        search: this.search,
                    }
                }).then(({data}) => {
                    if (data.data.length) {
                        this.total = data.meta.total,
                        this.page += 1;
                        this.items.push(...data.data);
                        $state.loaded();
                        this.isLoading = false;
                    } else {
                        this.isLoading = false;
                        $state.complete();
                    }
                });
            },

            userSearch: _.debounce(function(page) {
                this.isLoading = true;
                this.subject  = '';
                this.status   = '';
                this.refreshtable();
            }, 600),

            // sortByColumn(column, order = 'asc') {
            //     this.reset();
            //     if (column === this.sortedColumn) {
            //         this.order = (this.order === 'asc') ? 'desc' : 'asc'
            //     } else {
            //         this.sortedColumn = column;
            //         this.order = order;
            //     }

            //     this.fetch()
            // },

            reset() {
                this.items = [];
                this.page = 1;
            },

            updatestatus(status) {
                this.refreshtable();
                this.status = status;
            },

            refreshtable() {
                this.reset();
                this.fetch();
            },

            unsetsort(){
              this.subject  = '';
              this.status   = '';
              this.search   = '';
            },
        }
    }
</script>

<style scoped>

</style>
