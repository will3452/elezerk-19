<template>
    <div>
        <table class="w-full font-mono">
            <thead>
                <tr>
                    <th class="text-left border px-2 ">
                        Date
                    </th>
                    <th class="text-left border px-2 ">
                        Description
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="log in logs" :key="log.id">
                    <td class="border px-2">
                        {{ moment(log.created_at).format('ll') }}
                    </td>
                    <td class="border px-2">
                        {{ log.description }}
                    </td>
                </tr>
            </tbody>
        </table>
        <button v-if="more < card.logs.length" class="underline text-xs" @click="showMore">[more]</button>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    props: ['card'],
    data() {
        return {
            more: 3,
        }
    },
    computed: {
        logs() {
            try {
                let logs = this.card.logs;
                return logs.slice(0, this.more)
            } catch (error) {
                return []
            }
        }
    },
    methods: {
        moment,
        showMore() {
            this.more += 5;
        }
    }
}
</script>
