<template>
    <div>
    	<div class="grid-x mt-3">
	        <div class="medium-10">
	            <h2>Billing</h2>
	        </div>
	        <div class="medium-2">
	            <h3> &#8358;{{amountOwed}}.00</h3>
	            <p>Amount You Owe</p>
	        </div>
	    </div>
	    <hr>
        <h4>Invoices</h4>
         <table class="stack">
            <thead>
                <tr>
                    <th v-for="t_head in headers">
                        {{t_head.name}}
                        <a v-if="t_head.name === 'Name'" style="" @click.prevent="sortByColumn(t_head.sort)">
                                <i v-if="order === 'asc' " class="fas fa-sort-alpha-up"></i>
                                <i v-else class="fas fa-sort-alpha-down"></i>
                        </a>
                    </th>
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
                    <td v-if="data.status > 0"><user-add-payment :modal="data.id + 'b'" :selectedInvoice="data"></user-add-payment></td>
                </tr>
            </tbody>
        </table>
    </div>


</template>

<script>
    export default {
        props: ['user'],
        data () {
            return {
                dataSet: false,
                invoices: {},
                amountOwed: '',
                
                headers: [
                    {name: 'Date', sort: 'created_at'},
                    {name: 'InvoiceNo', sort: 'invoiceno'},
                    {name: 'Amount'},
                    {name: 'Owed'},
                    {name: 'Action'}
                    // {name: 'Action'}
                ],
                offset: 4,
                currentPage: 1,
                perPage: 25,
                sortedColumn: 'created_at',
                order: 'asc'  
            };
        },

        created () {
           axios.get(`/dashboard/${this.user.username}/getallinvoices`)
                .then(response => {
                    this.invoices = response.data.data
                }
            );

            axios.get(`/dashboard/${this.user.username}/totalamountowed`)
                .then(response => {
                    this.amountOwed = response.data
                }
            );
        },

        methods: {
           
        }
    }
</script>
</script>