<template>
    <div>
        <div class="my-2">
            <div class="flex justify-between items-center shadow-sm p-2 bg-white rounded-sm">
                <div class="flex" @click="showContent">
                    <div>
                        <bac-icon></bac-icon>
                    </div>
                    <div class="mx-2">
                        <h1>{{ bid.topic }} | {{ moment(bid.scheduled_date).calendar() }}</h1>

                        <div class="text-xs font-thin">
                            {{ bid.bid_no }} | {{ bid.category }}
                        </div>
                    </div>
                </div>
                <button @click="showContent">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </button>
            </div>
            <div class="bg-white p-2 border-t-2" v-show="show">
                <div>
                    <table class=" w-full text-xs">
                        <tr>
                            <td class="uppercase">
                                <div style="background:brown;color:white;display:inline-block;" class="p-1 rounded-md">
                                    Winner:
                                </div>
                            </td>
                            <td class="font-thin">
                                {{ winner }}
                            </td>
                        </tr>
                        <tr>
                            <td class="uppercase">
                                <div style="background:brown;color:white;display:inline-block;" class="p-1 rounded-md">
                                    Bidding Description:
                                </div>
                            </td>
                            <td class="font-thin">
                                {{ bid.description }}
                            </td>
                        </tr>
                        <tr>
                            <td class="uppercase">
                                <div style="background:brown;color:white;display:inline-block;" class="p-1 rounded-md">
                                    Bidding No:
                                </div>
                            </td>
                            <td class="font-thin">
                                {{ bid.bid_no }}
                            </td>
                        </tr>
                        <tr>
                            <td class="uppercase">
                                <div style="background:brown;color:white;display:inline-block;" class="p-1 rounded-md">
                                    Category:
                                </div>
                            </td>
                            <td class="font-thin">
                                {{ bid.category }}
                            </td>
                        </tr>
                        <tr>
                            <td class="uppercase">
                                <div style="background:brown;color:white;display:inline-block;" class="p-1 rounded-md">
                                    Schedule:
                                </div>
                            </td>
                            <td class="font-thin">
                                {{ moment(bid.scheduled_date).calendar() }}
                            </td>
                        </tr>
                        <tr>
                            <td class="uppercase">
                                <div style="background:brown;color:white;display:inline-block;" class="p-1 rounded-md">
                                    Price:
                                </div>
                            </td>
                            <td class="font-thin">
                                {{ new Intl.NumberFormat('en-US', {
                                    style: 'currency', currency: 'PHP'
                                }).format(bid.price)
                                }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import moment from 'moment'
import BacIcon from './BacIcon.vue'
export default {
    props: ['bid'],
    components: { BacIcon },
    data() {
        return {
            show: false,
        }
    },
    methods: {
        moment,
        showContent() {
            this.show = !this.show
        }
    },
    computed: {
        winner() {
            try {
                return this.bid.participants.find(x => x.has_won).user.name
            } catch (error) {
                return '---';
            }
        }
    }
}
</script>
