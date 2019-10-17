<template>
    <div>
        <button @click="$modal.show(modal)" class="small button">VIEW PAYMENTS</button>
        <modal :name="modal" height="auto" draggable=".window-header" class="scroll">
              <table class="stack">
                  <thead>
                      <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Trans Ref.</th>
                        <th>Status</th>
                      </tr>
                  </thead>
                  <tbody v-if="payments.length != 0">
                      <tr v-for="data in payments" :key="data.id">
                          <td v-text="data.date"></td>
                          <td v-text="data.amount"></td>
                          <td v-text="data.method"></td>
                          <td v-text="data.ref"></td>
                          <td v-text="data.status"></td>
                      </tr>
                  </tbody>
                  <div v-else>
                    <p>No payment records for this invoice</p>
                  </div>
              </table>
        </modal>
    </div>
    
</template>

<script>
    export default {
        props: ['modal', 'selectedInvoice'],
        name: "ViewInvoice",

        data () {
          return {
            payments: this.selectedInvoice.payments,
          }
        },


        methods: {

        }
    }
</script>

<style scoped>

.scroll {
    overflow: scroll;
}


</style>
