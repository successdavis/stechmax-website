<template>
    <v-card>
        <v-card-title>
            All Users Records
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on }">
                    <!--<button class="button small"><user-registration ></user-registration></button>-->
                    <v-btn color="primary" class="mb-2" v-on="on"><user-registration :modal="'regModal2'"></user-registration></v-btn>
                </template>

            </v-dialog>

            <v-text-field
                    v-model="search"
                    append-icon="search"
                    label="Search"
                    single-line
                    hide-details
            ></v-text-field>
        </v-card-title>

        <v-data-table
                :headers="headers"
                :items="items"
                :search="search"
                :pagination.sync="pagination"
                rows-per-page-text = "25"
                class="elevation-1"
        >
            <template v-slot:items="props">
                <td>{{ props.item.f_name }}</td>
                <td class="text-xs-right">{{ props.item.l_name }}</td>
                <td class="text-xs-right">{{ props.item.gender }}</td>
                <td class="text-xs-right">{{ props.item.phone }}</td>
                <td class="text-xs-right">{{ props.item.email }}
                <td class="justify-center layout px-0">
                    <v-icon
                            small
                            class="mr-2"
                            @click="$modal.show('register-user-modal')"
                    >
                        edit
                    </v-icon>
                    <v-icon
                            small
                            @click="deleteItem(props.item)"
                    >
                        delete
                    </v-icon>
                </td>
            </template>
        </v-data-table>
    </v-card>

</template>

<script>
    export default {
        data () {
            return {
                pagination: {
                rowsPerPage: 25, // -1 for All",
                sortBy: "f_name",
                },

                items: [],
                search: '',
                headers: [
                    {
                        text: 'First Name',
                        align: 'left',
                        sortable: true,
                        value: 'f_name'
                    },
                    {
                        text: 'Last Name',
                        align: 'left',
                        sortable: true,
                        value: 'l_name'
                    },
                    {
                        text: 'Gender',
                        align: 'left',
                        sortable: false,
                        value: 'name'
                    },
                    {
                        text: 'Phone',
                        align: 'left',
                        sortable: false,
                        value: 'name'
                    },
                    {
                        text: 'Email',
                        align: 'left',
                        sortable: true,
                        value: 'name'
                    },
                    {
                        text: 'Actions',
                        value: 'name',
                        sortable: false }
                ]
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page) {
                axios.get('/dashboard/get_users').then(this.refresh);
            },

            refresh({data}) {
                this.items = data;

                // window.scrollTo(0, 0);
            },
        }
    }
</script>

<style scoped>

</style>