<template>
    <main class="mt-10" >
        <div class="border w-fit p-3 flex flex-col md:flex-row gap-2">
            <button id="pls" data-dropdown-toggle="plslist"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Book State
                <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>
            <span
                class="ml-3 bg-slate-100 border text-blue-800 text-xs font-semibold mr-2 px-9 py-3 rounded dark:bg-blue-200 dark:text-blue-800">
                {{ state }}
            </span>
        </div>
        <div id="plslist"
            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                <li class="text-center" v-for="stateData in states" @click="clickDD(stateData)">
                    <a href="#" class="block py-2.5 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        {{ stateData }}
                    </a>
                </li>
            </ul>
        </div>

        <div class="overflow-x-auto relative mt-5 border rounded">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6" v-for="th in ['Number', 'Detail', 'State']">
                            {{ th }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="book in computedBooks">
                        <td class="py-4 px-6">
                            {{ book.court.number }}
                        </td>
                        <td class="py-4 px-6">
                            {{ book }}
                        </td>
                        <td class="py-4 px-6">
                            {{ book.state }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <section class="flex flex-col items-center mt-5">
                    <!-- pagination -->
                    <!-- Help text -->
                    <span class="text-sm text-gray-700 dark:text-gray-400">
                        Showing <span class="font-semibold text-gray-900 dark:text-white">1</span> to <span
                            class="font-semibold text-gray-900 dark:text-white">10</span> of <span
                            class="font-semibold text-gray-900 dark:text-white">100</span> Entries
                    </span>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <!-- Buttons -->
                        <button
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-400 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Prev
                        </button>
                        <button
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-400 border-0 border-l border-gray-100 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            Next
                            <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </section>


    </main>
</template>

<script>
export default {
    async mounted() {
        const origin = window.location.origin;
        // http://localhost:8000/api/books?page=2 for pagination
        if (!this.secretAdminCode)
            this.books = await fetch(`${origin}/api/books`).then(res => res.json());
        else {
           let books = await fetch(`${origin}/api/books/admin`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ secret: this.secretAdminCode })
            }).then(res => res.json());
            this.books = books.data;
        }

    },
    data() {
        return {
            books: { data: [] },
            states: ['All', 'Pending', 'Booked', 'Empty'],
            state: 'All',
        }
    },
    props: {
        secretAdminCode: {
            type: String,
            default: ''
        },
    },
    methods: {
        clickDD(state) {
            const targetEl = document.getElementById('plslist');
            const triggerEl = document.getElementById('pls');
            const dropdown = new Dropdown(targetEl, triggerEl);
            this.state = state;
            dropdown.hide();
        }

    },
    computed: {
        computedBooks() {
            const books = this.books.data.filter((book) => {
                if (this.state.toLowerCase() == 'all') return true;
                if (book.state.toLowerCase() == this.state.toLowerCase()) return true;
            });
            return books;
        }
    },
}
</script>

<style lang="scss" scoped>

</style>
