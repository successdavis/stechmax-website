<template>
	<div>
		<div class="grid-x grid-padding-x grid-container">
            <div class="small-2 medium-2">
                <label>Per Page
                    <select v-model="perPage" @change="refetch">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="all">All</option>
                    </select>
                </label>
            </div>
            <span style="margin-right: 1em"></span>
            <div class="small-3 medium-2">
                <label>Sort by:
                    <select>
                        <option  value="completed='true'">Completed</option>
                    </select>
                </label>
            </div>
	 		<table class="stack">
	            <thead>
		            <tr>
		                <td v-for="t_head in headers">
		                    {{t_head.name}}
		                    <a v-if="t_head.name === 'Name'" style="" @click.prevent="sortByColumn(t_head.sort)">
		                            <i v-if="order === 'asc' " class="fas fa-sort-alpha-up"></i>
		                            <i v-else class="fas fa-sort-alpha-down"></i>
		                    </a>
		                </td>
		            </tr>
		        </thead>

		        <tbody>
		            <tr v-for="data in data" :key="data.id">
		                <td v-for="(value, key) in data" v-text="value">
		                </td>
		                <!-- <td ><view-user :modal="'modal' + data.id"></view-user></td> -->
		            </tr>
		        </tbody>
		    </table>
        </div>
	</div>
</template>

<script>
	export default {
		props: ['data', 'headers'],

		data () {
			return {
				sort: {},
			}
		}
	}
</script>