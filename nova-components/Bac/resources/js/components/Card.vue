<template>
    <div>
        <div class="flex hidden md:flex bg-white p-4 border-t-8 " style="border-color:brown;">
            <div class="w-4/5 p-2 ">
                <div class="flex items-center px-2 pb-2" style="border-color:brown">
                    <h1 class="font-bold" style="color:brown">
                        BID RESULTS
                    </h1>
                    <div class="mx-2">
                        <select v-model="category" name="" id="" class="border px-2 py-1 ">
                            <option value="" selected disabled>
                                Select Category
                            </option>
                            <option :value="c" v-for="c in categories" :key="c">
                                {{ c }}
                            </option>
                        </select>
                    </div>

                    <div class="mx-2">
                        <input v-model="topic" type="text" placeholder="Search Bidding No." class="border px-2 py-1">
                    </div>
                    <div>
                        Successful bids for (month):
                    </div>
                </div>
                <div style="max-height:50vh; overflow-y: auto;" class="scroller">
                    <bid-item :bid="bid" :key="bid.id" v-for="bid in filtered"></bid-item>
                    <p v-show="!filtered.length">No bids to show</p>
                </div>
                <div>
                    <h1 class="text-black uppercase font-bold px-2 pb-2" style="border-color:brown;color:brown;">Logs
                    </h1>
                    <Logs :card="card" />
                </div>
            </div>
            <div class="w-1/5 mx-2">
                <Visitor :card="card" />
                <img src="https://cnsc.edu.ph/cnsc-website/images/quicklinks/FOI.png" alt="">
                <img src="https://cnsc.edu.ph/cnsc-website/images/quicklinks/TS.png" alt="">
                <Stats :card="card" />
            </div>
        </div>
        <div class=" md:hidden bg-white p-2 border-t-8 " style="border-color:brown;overflow-x: auto;">
            <div class="w-full">
                <h1 class="font-bold text-center mb-2" style="color:brown">
                    BID RESULTS
                </h1>
                <div class="flex items-center px-2 pb-2" style="border-color:brown">

                    <div class="mx-2">
                        <select v-model="category" name="" id="" class="border px-2 py-1 ">
                            <option value="" selected disabled>
                                Select Category
                            </option>
                            <option :value="c" v-for="c in categories" :key="c">
                                {{ c }}
                            </option>
                        </select>
                    </div>

                    <div class="mx-2">
                        <input v-model="topic" type="text" placeholder="Search Bidding No." class="border px-2 py-1">
                    </div>
                </div>
                <div style="max-height:50vh; overflow-y: auto;" class="scroller">
                    <bid-item :bid="bid" :key="bid.id" v-for="bid in filtered"></bid-item>
                    <p v-show="!filtered.length">No bids to show</p>
                </div>
            </div>
            <div class="w-full mt-2">
                <Visitor :card="card" />
                <img style="display:block;" src="https://cnsc.edu.ph/cnsc-website/images/quicklinks/FOI.png" alt="">
                <img style="display:block;" src="https://cnsc.edu.ph/cnsc-website/images/quicklinks/TS.png" alt="">
                <Stats :card="card" />

                <div>
                    <h1 class="text-black uppercase font-bold px-2 pb-2" style="border-color:brown;color:brown;">Logs
                    </h1>
                    <Logs :card="card" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BidItem from './BidItem.vue';
import Visitor from './Visitor.vue';
import Stats from './Stats.vue';
import Logs from './Logs.vue'
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],
    data() {
        return {
            topic: '',
            category: ''
        }
    },
    components: {
        BidItem,
        Visitor,
        Stats,
        Logs,
    },
    mounted() {
        //
    },
    computed: {
        categories() {
            let categories = this.card.bids.map(x => x.category)
            return Array.from(new Set(categories))
        },
        filtered() {
            try {
                let bids = this.card.bids;
                if (this.topic != '') {
                    bids = bids.filter(x => x.bid_no.includes(this.topic))
                }

                if (this.category != '') {
                    bids = bids.filter(x => x.category == this.category)
                }

                return bids;
            } catch (error) {
                return [];
            }
        },
    },
}
</script>
