<template>
    <div>
        <button @click="$modal.show(modal)" class="small button">PAY INVOICE</button>
        <modal :name="modal" height="auto" draggable=".window-header" class="scroll">
          <div class="grid-container">
            <div class="grid-x grid-padding-x mt-2">
                <div class="cell medium-5">
                  <!-- /dashboard/billing/{invoice}/clearinvoicedebt' -->
                  <a class="medium button expanded" :href="selectedInvoice.id + '/clearinvoicedebt'">Pay Total Debt</a>
                  <h4 class="text-center">&#8358; {{selectedInvoice.status}}</h4>
                </div>
                <div class="cell medium-1">or</div>
                <div class="cell medium-6">
                  <a class="medium button expanded" v-if="!show" @click.prevent="show = true">Specify Amount</a>
                  <a class="medium button expanded" v-if="show" @click.prevent="pay">Pay</a>
                  <input type="text" v-model="amount" v-if="show" placeholder="Enter Amount Here">
                </div>
            </div>
          </div>
        </modal>
    </div>
    
</template>

<script>
    export default {
        props: ['modal', 'selectedInvoice'],
        name: "ViewInvoice",

        data () {
          return {
            show: false,
            payments: this.selectedInvoice.payments,
            amount: '',
          }
        },


        methods: {
          pay () {
            if (this.amount > this.selectedInvoice.status) {
              flash('Amount cannot be greater than ' + this.selectedInvoice.status, 'failed')
            }else if(this.amount < 500) {
              flash('Amount cannot be less than 500.00', 'failed')
            }else {
              window.location.href = "/dashboard/billing/" + this.selectedInvoice.id + "/payspecifyamount?amount=" + this.amount;
            }
          }
        }
    }
</script>

<style scoped>

.scroll {
    overflow: scroll;
}


</style>
