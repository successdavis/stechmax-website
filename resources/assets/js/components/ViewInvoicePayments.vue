<template>
    <div>
        <button @click="$modal.show(modal)" class="small button">VIEW PAYMENTS</button>
        <modal :name="modal" height="auto" draggable=".window-header" class="scroll">
              
        </modal>
    </div>
    
</template>

<script>
    export default {
        props: ['modal', 'selectedInvoice'],
        name: "ViewInvoice",

        data () {
          return {
            editing: false,
            date_joined: this.selectedUser.Date_Joined,
            email: this.selectedUser.email,
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

.user-header,
.switch {
  display: flex;
}

.user-header {
  justify-content: space-between;
  background: #1b222d;
  color: white;
  align-items: center;
  border-bottom: 5px solid red;
  padding: .2em 1.5em;
}

.switch {
  margin-bottom: 0;
}

.text {
    display: inline-block;
    color: white;
    /* padding: 0; */
    margin: 0;
    align-self: center;
    padding-right: 1em;
  }

.user-passport{
    display: flex;
    justify-content: center;
    align-items: flex-start;
  }

.user-passport--info {
    margin-top: 32px;
    padding-left: 1em;
}
</style>
