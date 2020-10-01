<script>
    import collection from '../mixins/collection';
    import InfiniteLoading from 'vue-infinite-loading';
    import _ from 'lodash';

    export  default {
        components: {
            InfiniteLoading,
        },
        data() {
            return {
                isLoading: '',
                sorttab: '',
                infiniteId: +new Date(),
                dataSet: false,
                items: [],
                total: '',
                pagination: {
                    meta: { to: 1, from: 1 }
                },
                offset: 4,
                currentPage: 1,
                perPage: 50,
                sortedColumn: 'f_name',
                order: 'asc',
                page: 1,
                search: ''
            };
        },

        created() {
            Event.$on('newUserCreated', (user) => this.items.unshift(user));
        },
        methods: {
            fetch($state) {
                axios.get(`${location.pathname}/datatable`, {
                    params: {
                        page: this.page,
                        column: this.sortedColumn,
                        order: this.order,
                        per_page: this.per_page,
                        search: this.search,
                    }
                }).then(({data}) => {
                    console.log(data)
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
                this.reset();
                this.fetch();
            }, 600),

            sortByColumn(column, order = 'asc') {
                this.reset();
                if (column === this.sortedColumn) {
                    this.order = (this.order === 'asc') ? 'desc' : 'asc'
                } else {
                    this.sortedColumn = column;
                    this.order = order;
                }

                this.fetch()
            },

            reset() {
                this.items = [];
                this.page = 1;
            },

            updatesorttab(tab) {
                this.sorttab = tab
            },
        }
    }
</script>

<style scoped>

</style>
