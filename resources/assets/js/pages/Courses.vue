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
                order: 'asc' 
            };
        },

        created() {
            this.fetch();
            this.fetchSubjects();
            // Event.$on('newUserCreated', (user) => this.items.unshift(user));
        },

        methods: {
              fetchSubjects(){
                axios.get('/api/subjects')
                .then((data) => {
                  console.log(data);
                })
              },

              fetch($state) {
                axios.get(`${location.pathname}/datatable`, {
                    params: {
                        page: this.page,
                        column: this.sortedColumn,
                        order: this.order,
                        per_page: this.per_page,
                        // search: this.search,
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

            // userSearch: _.debounce(function(page) {
            //     this.isLoading = true;
            //     this.reset();
            //     this.fetch();
            // }, 600),

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

            // reset() {
            //     this.items = [];
            //     this.page = 1;
            // },

            // updatesorttab(tab) {
            //     this.sorttab = tab
            // },





            // fetch(page) {
            //     axios.get(this.url(page)).then(this.refresh);
            // },

            // url(page) {
            //     if (! page) {
            //         let query = location.search.match(/page=(\d+)/);

            //         page = query ? query[1] : 1;
            //     }
            //     return `${location.pathname}/datatable?page=${page}&column=${this.sortedColumn}&published=${this.status}&type_id=${this.type}&order=${this.order}&per_page=${this.perPage}`;
            // },

            // sortByColumn(column) {
            //     if (column === this.sortedColumn) {
            //         this.order = (this.order === 'asc') ? 'desc' : 'asc'
            //     } else {
            //         this.sortedColumn = column;
            //         this.order = 'asc'
            //     }

            //     this.fetch()
            // },

            // refresh({data}) {
            //     this.dataSet = {
            //         next_page_url : data.links.next,
            //         current_page: data.meta.current_page,
            //         per_page: data.meta.per_page,
            //         total: data.meta.total,
            //         prev_page_url: data.links.prev
            //     };
            //     this.items = data.data;
            //     this.pagination = data;

            //     window.scrollTo(0, 0);
            // },
        }
    }
</script>

<style scoped>

</style>
