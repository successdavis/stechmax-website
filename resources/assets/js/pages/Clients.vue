<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import _ from 'lodash';
    import NewClient from '../pages/NewClient.vue';
    import collection from '../mixins/collection';
    export default {

        components: {NewClient, InfiniteLoading},

        mixins: [collection],

        data() {
            return {
                addingClient:'',
                isLoading: '',
                sorttab: '',
                infiniteId: +new Date(),
                dataSet: false,
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
            }
        },

        created() {
            Event.$on('newClientCreated', (client) => this.items.unshift(client));
            Event.$on('clientupdated', (client) => this.clientupdated());
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
                        this.total = data.total,
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

            deleteClient(client, index) {
                axios.delete('api/deleteclient/' + client.id)
                .then(() => {
                    flash('Client deleted successfully', 'success');
                    this.remove(index);
                    this.total -=1;
                }).catch(() => {
                    flash("Sorry! we couldn\'t delete this client", 'failed' );
                })
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

            generatelink(client, index) {
                axios.get(`generateclienttoken/${client.id}`)
                .then (data => {
                    console.log(data.data);
                    this.doCopy(window.location.origin + data.data);
                })
                .catch(() => {
                    console.log('error');
                    flash('error generating link','failed')
                })
            },

            doCopy(message) {
                this.$copyText(message).then(function (e) {
                  flash('Copied')
                  console.log(e)
                }, function (e) {
                  alert('Can not copy')
                  console.log(e)
                })
            },
            clientupdated() {
                this.reset();
                this.fetch();
            }
        }
    }
</script>
