<template>
    <nav aria-label="Pagination" v-if="shouldPaginate">
      <ul class="pagination text-center">
         <li class="current"><span class="show-for-sr">You're on page</span> {{current_page}}</li>
          <li v-show="prevUrl" class="pagination-previous"><a href="#" aria-label="Previous page" rel="Previous" @click.prevent="page--">Previous</a></li>

        <li class="ellipsis"></li>
        
        <li v-show="nextUrl" class="pagination-next"><a href="#" aria-label="Next page" rel="next" @click.prevent="page++">Next</a></li>
          <li class="current"><span class="show-for-sr">You're on page</span> {{per_page}} Per Page</li>
          <li class="current"><span class="show-for-sr">You're on page</span> Total {{total}}</li>
      </ul>
    </nav>
</template>

<script>
    export default {
        props: ['dataSet'],

        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false,
                current_page: 1,
                per_page: '',
                total: ''
            }
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
                this.current_page = this.dataSet.current_page;
                this.per_page = this.dataSet.per_page;
                this.total = this.dataSet.total;
            },

            page() {
                this.broadcast().updateUrl();
            }
        },

        computed: {
            shouldPaginate() {
                return !! this.prevUrl || !! this.nextUrl;
            }
        },

        methods: {
            broadcast() {
                this.$emit('changed', this.page);

                return this;
            },

            updateUrl() {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
    
</script>
