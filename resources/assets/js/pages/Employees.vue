<template>
    <div>
        <button class="button" @click="$modal.show('adjustpayroll')" v-show="checkedRows.length != 0">Adjust Payroll</button>
        <modal name="adjustpayroll" height="auto" draggable=".window-header" class="scroll">
            <div class="section">
                <div class="field">
                    <div class="select is-fullwidth">
                        <select class="is-fullwidth" v-model="selectedAdjustment">
                            <option value="" selected>Select One</option>
                            <option v-for="(adjustment, key) in adjustments" v-text="key + ' ' + adjustment " :value="key"></option>
                            <option>More</option>
                        </select>
                    </div>
                </div>
                <form @submit.prevent="makeAdjustment">
                    <div v-show="selectedAdjustment === 'More' ">
                        <div class="field">
                            <label>Enter Description Here</label>
                            <div class="control">
                                <input class="input" type="text" name="description" v-model="adjustmentForm.description" placeholder="Enter Description">
                            </div>
                        </div>
                        <div class="field">
                            <label>Type</label>
                            <div class="select is-fullwidth control">
                                <select class="is-fullwidth" v-model="adjustmentForm.type">
                                    <option value="" selected>Pick One</option>
                                    <option value="Credit">Credit</option>
                                    <option value="Deduction">Deduction</option>
                                </select>
                            </div>
                        </div>
                        <div class="field">
                          <label class="label">Amount</label>
                          <div class="control">
                            <input class="input" v-model="adjustmentForm.amount" type="number" step="any" />
                          </div>
                        </div>
                    </div>
                    <button class="button is-medium is-success">Adjust</button>
                </form>
                <div v-show="employeeswithadjustmenterror.length != 0">
                    <p>This Adjustment had been previously added for this employees</p>
                    <ul>
                        <li v-for="employee in employeeswithadjustmenterror" v-text="employee"></li>
                    </ul>             
                </div>
            </div>
        </modal>


        <b-table 
            :data="data"
            :checked-rows.sync="checkedRows"
            checkable
            :checkbox-position="checkboxPosition">

            <template slot-scope="props">
                <b-table-column field="name" label="Name" width="40" sortable numeric>
                    {{ props.row.name }}
                </b-table-column>

                <b-table-column field="paygrade" label="Paygrade" sortable>
                    {{ props.row.paygrade }}
                </b-table-column>

                <b-table-column field="basic" label="Basic Salary" sortable>
                    {{ props.row.basic }}
                </b-table-column>

                <b-table-column field="balance" label="Unpaid Balance" sortable>
                    {{ props.row.balance }}
                </b-table-column>

                <b-table-column field="date_employed" label="Date Employed" sortable>
                    {{ props.row.date_employed }}
                </b-table-column>

                <b-table-column field="years" label="Years with us" sortable>
                    {{ props.row.years }}
                </b-table-column>

                <b-table-column field="gender" label="Gender">
                    <b-icon
                        pack="fa"
                        :icon="props.row.gender === 'Male' ? 'mars' : 'venus'">
                    </b-icon>
                    {{ props.row.gender }}
                </b-table-column>
                <b-table-column field="gender" label="Action">
                    <a :href="'/viewemployee/' + props.row.user_id" class="button small is-info">View</a>
                </b-table-column>
            </template>
        </b-table>

    </div>
</template>

<script>
    import _ from 'lodash';
    import collection from '../mixins/collection';
    export default {

        mixins: [collection],

        data() {
            return {
                data: [],
                checkboxPosition: 'left',
                checkedRows: [],
                columns: [
                    {
                        field: 'name',
                        label: 'Name',
                    },
                    {
                        field: 'paygrade',
                        label: 'Paygrade',
                    },
                    {
                        field: 'basic',
                        label: 'Basic Salary',
                        centered: true
                    },
                    {
                        field: 'balance',
                        label: 'Balance',
                    },
                    {
                        field: 'date_employed',
                        label: 'Date Employed',
                    },
                    {
                        field: 'years',
                        label: 'Years with us',
                    }
                ],
                dataSet: false,
                isLoading: '',
                employeeswithadjustmenterror: [],
                selectedAdjustment: '',
                adjustments: {
                    Dearness_bonus: 1000,
                    Bonus: 500,
                    Holiday_allowance: 1500,
                },
                adjustmentForm: new Form({
                    description: '',
                    amount: '',
                    type: '',
                    employees: [],
                    isMore: true,
                }),
                infiniteId: +new Date(),
                total: '',
                pagination: {
                    meta: { to: 1, from: 1 }
                },
                offset: 4,
                currentPage: 1,
                perPage: 50,
                sortedColumn: 'employment_date',
                order: 'asc',
                page: 1,
                search: '',
            }
        },

        created() {
            this.fetch();
        },

        watch: {
            selectedAdjustment(value){
                if (value !== 'More') {
                    this.adjustmentForm.description = value
                    this.adjustmentForm.amount = this.adjustments[value]
                    this.adjustmentForm.isMore = false
                }else {
                    this.adjustmentForm.isMore = true
                }
            },
            checkedRows(value){
                this.adjustmentForm.employees = this.checkedRows;
            }
        },

        methods: {
            makeAdjustment(){
                this.adjustmentForm.post('adjustpayroll')
                .then((data) => {
                    flash('Success')
                    this.employeeswithadjustmenterror = data
                })
                .catch(() => {
                    flash('Payroll Adjustment Failed', 'failed');
                })
            },

            fetch($state) {
                axios.get(`/employeelist`, {
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
                        this.data.push(...data.data);
                        $state.loaded();
                    this.isLoading = false;
                    } else {
                        this.isLoading = false;
                        $state.complete();
                    }
                });
            },

            employeeSearch: _.debounce(function(page) {
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
            doCopy(message) {
                this.$copyText(message).then(function (e) {
                  flash('Copied')
                  console.log(e)
                }, function (e) {
                  alert('Can not copy')
                  console.log(e)
                })
            },
        }
    }
</script>