<template>
    <main>

        <div class="overflow-x-auto relative mt-5  rounded">
            <div class="mb-3 flex gap-x-4">
                <h1 class="text-lg relative top-[.5rem]"> Book Court {{ courtNumber }} Avaibility </h1>
                <form action="" class="flex gap-x-2">
                    <label class="relative top-2"> <p>Date:</p></label>
                    <input type="date" name="book_date" id="book_date" class="rounded" ref="ref_book_date" required>
                    <input type="submit" class="border rounded px-2">
                </form>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <!-- ,'Detail' -->
                        <th scope="col" class="py-3 px-6"
                            v-for="th in [ 'No','Time Start', 'Time End', 'Status']">
                            {{ th }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="book,no in computedBooks">
                        <td class="py-4 px-6">
                           {{ no+1 }}
                        </td>
                        <!-- <td class="py-4 px-6">
                            {{ book }}
                        </td> -->
                        <td class="py-4 px-6">
                            {{ $convertTo12hoursFormat(book.time_book_start) }}
                            <!-- {{ book.time_book_start }} -->
                        </td>
                        <td class="py-4 px-6">
                            {{ $convertTo12hoursFormat(book.time_book_end) }}
                        </td>
                        <td class="py-4 px-6" :class="coloringStatus(book.state)">
                            {{ $toUpperCaseFirstLetter(book.state) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</template>

<script>

export default {
    mounted() {
        // console.log('%c window.location','color: orange',window.location);
        const date = this.$refs.ref_book_date;
        date.valueAsDate = this.book_date ? new Date(this.book_date) : new Date();
    },
    data() {
        return {
            states: ['All', 'Pending', 'Booked', 'Empty'],
            state: 'All',
        }
    },
    props: {
        books: {
            type: String,
            default: ''
        },
        book_date: {
            type: String,
            default: ''
        },
        courtNumber: {
            type: String,
            default: {}
        },
    },
    methods: {
        coloringStatus(state){
            const lowerCaseState = state.toLowerCase();
            switch (lowerCaseState) {
                case 'pending':
                    return ['text-yellow-400']
                case 'booked':
                    return ['text-blue-400']
                case 'empty':
                    return ['text-green-400']
                case 'empty':
                    return ['']
                default:
                    return [''];
            }
        },
        clickDD(state) {
            const targetEl = document.getElementById('plslist');
            const triggerEl = document.getElementById('pls');
            const dropdown = new Dropdown(targetEl, triggerEl);
            this.state = state;
            dropdown.hide();
        },
    },
    computed: {
        computedBooks() {
            // const books = this.books.data.filter((book) => {
            //     if (this.state.toLowerCase() == 'all') return true;
            //     if (book.state.toLowerCase() == this.state.toLowerCase()) return true;
            // });
            const books = JSON.parse(this.books);
            return books;
        }
    },
}
</script>

<style lang="scss" scoped>

</style>
