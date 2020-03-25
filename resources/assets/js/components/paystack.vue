<template>
	<div>
		<p>Click button below to pay using your credit card with paystack</p>
        <div class="mb-2">

          <form method="post" @submit.prevent="payWithPaystack">
              <button  type="submit" class="small button">
                <img :src="image">
              </button>
          </form>
        </div>
	</div>
</template>

<script>
	export default {
		props: {
			image: {default: true},
			class: {default: false},
		},
		data () {
			return {
				class: this.class,
			}
		},

		methods: {
			payWithPaystack(){
			    var handler = PaystackPop.setup({
			      key: 'pk_test_1b32db4394768e9819ebbdaacea3dedadf74aa4a',
			      email: 'customer@email.com',
			      amount: 10000,
			      currency: "NGN",
			      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
			      metadata: {
			         custom_fields: [
			            {
			                display_name: "Mobile Number",
			                variable_name: "mobile_number",
			                value: "+2348012345678"
			            }
			         ]
			      },
			      callback: function(response){
			          alert('success. transaction ref is ' + response.reference);
			      },
			      onClose: function(){
			          alert('window closed');
			      }
			    });
			    handler.openIframe();
			  }
		}
	}

</script>