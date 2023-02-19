<template>
    <div>
        <a href="#" style="background:brown;color:white; font-family: monospace;"
            class="border rounded-md p-1 px-2 block my-2 flex justify-between">
            Bids <span>{{ card.bids.length }}</span>
        </a>
        <a href="#" style="background:brown;color:white; font-family: monospace;"
            class="border rounded-md p-1 px-2 block my-2 flex justify-between">
            Events <span>{{ card.events.length }}</span>
        </a>
        <a href="#" style="background:brown;color:white; font-family: monospace;"
            class="border rounded-md p-1 px-2 block my-2 flex justify-between">
            Users <span>{{ card.users.length }}</span>
        </a>
        <a href="#" style="background:brown;color:white; font-family: monospace;"
            class="border rounded-md p-1 px-2 block my-2 flex justify-between">
            Announcements <span>{{ card.announcements.length }}</span>
        </a>
    </div>
</template>

<script>
export default {
    props: ['card']
}
</script>
