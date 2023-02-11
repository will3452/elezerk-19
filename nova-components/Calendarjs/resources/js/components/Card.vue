<template>
    <div>
        <iframe src="/calendar" frameborder="0" style="width:100%;height:100vh;"></iframe>
    </div>
</template>
<script>

export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    mounted() {
    }
}
</script>
