<template>
    <section class="lg:w-11/12 mx-auto">
        <h1 class="text-2xl text-center my-6"> Courts Futsal </h1>
        <div v-for="court in courtsParse" class="mx-3 my-5 px-3 py-6 border rounded-md">
            <h2 class="text-lg font-medium ml-1 mb-2">Court Number {{ court.number }}</h2>
            <!-- :href="String(routebook).replace("0",item.id)" -->

            <section class="overflow-x-auto relative shadow-md mb-5">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 rounded">
                    <thead class="text-xs text-gray-700 uppercase bg-blue-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <!-- <th scope="col" class="py-3 px-6">
                                Court Number
                            </th> -->

                            <th scope="col" class="py-3 px-6">
                                floor type
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Hourly rate
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <!-- <th scope="row"
                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ court.number }}
                            </th> -->
                            <td class="py-4 px-6">
                                {{ court.type_floor }}
                            </td>
                            <td class="py-4 px-6">

                                RM{{ court.hour_rate }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <!-- class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> -->
            <div>
                <a type="button" :href="`${routebook}\\${court.id}`"
                    class="flex ml-2 relative w-fit bottom-[2px] text-sm px-5 py-3 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-xl text-center mb-2">
                    <span >Book</span>
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                        class="w-6 h-5"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75h1.5m9 0h-9">
                        </path>
                    </svg>
                </a>
            </div>

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
