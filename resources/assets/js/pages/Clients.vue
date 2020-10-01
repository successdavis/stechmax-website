<script>
    import collection from '../mixins/collection';
    import InfiniteLoading from 'vue-infinite-loading';
    import _ from 'lodash';
    // import NewClient from './NewClient.vue';
    import NewClient from '../pages/NewClient.vue';

    export  default {
        components: {
            InfiniteLoading,
            NewClient,
        },
        data() {
            return {
                addingClient: false,
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
                sortedColumn: 'fullname',
                order: 'asc',
                page: 1,
                search: ''
            };
        },

        created() {
            Event.$on('newClientCreated', (client) => this.items.unshift(client));
        },
        methods: {
            fetch($state) {
                axios.get(`/clients`, {
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
                        // this.total = data.total,
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

            clientSearch: _.debounce(function(page) {
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
