<template>
    <div class="border-dashed border-2 p-2 font-mono text-black" style="border-color:brown;">
        <h1 class="font-bold text-black text-center uppercase">
            Visitors
        </h1>
        <div class="flex justify-between">
            <span>Today</span>
            <span>{{ card.visit_today.length }}</span>
        </div>
        <div class="flex justify-between">
            <span>Week</span>
            <span>{{ card.visit_week.length }}</span>
        </div>
        <div class="flex justify-between">
            <span>All</span>
            <span>{{ card.visit_all.length }}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['card'],
}
</script>
