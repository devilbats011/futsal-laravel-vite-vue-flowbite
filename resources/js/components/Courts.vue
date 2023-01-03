<template>
    <section>
        <h1 class="text-xl text-center"> Courts Futsal </h1>
        <div v-for="item in courtsParse" class="m-3 p-3 border">
            <h2 class="text-lg">Court Number {{ item.number }}</h2>
            <!-- :href="String(routebook).replace("0",item.id)" -->
            <a type="button"
            :href="`${routebook}\\${item.id}`"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Book
            </a>

        </div>
    </section>
</template>

<script>
export default {
    props: {
        routebook: String,
        courts: String
    },
    mounted() {
        console.log(this.routebook, "-rr-", this.courtsParse);
    },
    computed: {
        courtsParse() {
            return JSON.parse(this.courts);
        }
    },
}
</script>

<style lang="scss" scoped>

</style>
