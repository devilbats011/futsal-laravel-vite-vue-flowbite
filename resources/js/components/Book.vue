<template>
    <main>

        <div class="overflow-x-auto relative mt-5  rounded">
            <div class="mb-3 flex gap-x-4">
                <h1 class="text-lg relative top-[.5rem]"> Book Court {{ computedCourt.number }} Avaibility </h1>
                <form action="" class="flex gap-x-2">
                    <label class="relative top-2">
                        <p>Date:</p>
                    </label>
                    <input v-model="date" type="date" name="book_date" id="book_date" class="rounded"
                        ref="ref_book_date" required>
                    <input type="submit" class="border rounded px-2">
                </form>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <!-- ,'Detail''Pick', -->
                        <th scope="col" class="py-3 px-6" v-for="th in ['No', 'Time Start', 'Time End', 'Status']">
                            {{ th }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border"
                        :class="trClassBehaviour(book)" v-for="book, no in booksData"
                        @click="(event) => clickBook(book, event)" :id="'id-book-' + no">
                        <td class="py-4 px-6">
                            {{ no+ 1 }}
                        </td>
                        <!--  v-model="book.pick" -->
                        <!-- <td class="py-4 px-6 text-base">
                            {{ book.pick }}

                        </td> -->
                        <td class="py-4 px-6">
                            {{ $convertTo12hoursFormat(book.time_book_start) }}
                            <!-- {{ book.time_book_start }} -->
                        </td>
                        <td class="py-4 px-6">
                            {{ $convertTo12hoursFormat(book.time_book_end) }}
                        </td>
                        <td class="py-4 px-6 text-base" :class="coloringStatus(book.state)">
                            {{ $toUpperCaseFirstLetter(book.state) }}
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        <form class="mt-5 p-5" method="POST" :action="routeAction">
            <input type="hidden" name="_token" :value="csrf" />
            <input type="hidden" name="court_id" :value="court.id" />
            <input type="hidden" name="device" id="device" :value="device" />

            <div class="relative z-0 mb-6 w-full group">
                <input type="date" name="book_date" id="book_date"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    required ref="refDate" v-model="date" disabled />
                <label for="book_date"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Date Booking
                </label>
            </div>

            <div class="pb-6">
                <h2 class="font-normal text-md">
                    ~ Time Booking (Time Start & Time End) Available Around 9-24 (24 hour system) only ~
                </h2>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <input type="number" name="time_book_start" min="9" max="24" id="floating_company"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " :value="sortArea[0]?.book?.time_book_start" required />
                    <!-- v-model="sortArea[0]?.book?.time_book_start" -->
                    <label for="time_book_start"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Time Start (24 Hour System)
                    </label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="number" name="time_book_end" min="9" max="24" id="floating_company"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " :value="sortArea[1]?.book?.time_book_end ?? sortArea[0]?.book.time_book_end"
                        required />
                    <!-- v-model="sortArea[1]?.book?.time_book_end" -->
                    <label for="time_book_end"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Time End (24 Hour System)
                    </label>

                </div>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <input type="text" name="name" id="name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <input type="email" name="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <input type="tel" name="phone_no" id="phone_no"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="phone_no"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Phone number (1234567890)</label>
            </div>


            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

    </main>
</template>

<script>
import moment from 'moment';

export default {
    mounted() {

        //* mount device
        this.device = window.navigator.userAgent;

        //* mount date
        this.date = moment(new Date()).format('yyyy-MM-D');

        // console.log(moment().format('D-mm-yyyy'));
        // this.$refs.refDate.valueAsDate = new Date();
        // const date = this.$refs.ref_book_date;
        // date.valueAsDate = this.book_date ? new Date(this.book_date) : new Date();

        //* mount books
        let books = JSON.parse(this.books);
        books.map((b) => {
            if (b.state.toLowerCase() != 'empty')
                b.pick = '';
            else
                b.pick = false;
            return b;
        });
        this.booksData = books;
    },
    data() {
        return {
            date: '',
            device: '',
            booksData: [],
            area: [],
            states: ['All', 'Pending', 'Booked', 'Empty'],
            state: 'All',
        }
    },
    props: {
        errors: {
            type: String,
            default: ''
        },
        csrf: { type: String, default: '' },
        books: {
            type: String,
            default: ''
        },
        routeAction: {
            type: String,
            default: ''
        },
        book_date: {
            type: String,
            default: ''
        },
        // courtNumber: {
        //     type: String,
        //     default: {}
        // },
        court: {
            type: String,
            default: ''
        },
    },
    methods: {
        trClassBehaviour(book) {
            let sumClass = book.state.toLowerCase() == 'empty' ? 'cursor-pointer hover:border-slate-500 hover:bg-slate-500 hover:text-slate-100 hover:text-base' : '';
            return sumClass;
        },
        clickBook(book, event) {
            if (book.state.toLowerCase() == 'empty') {
                // console.log('pickle rick: ', book.pick, event.target);
                //* <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border"
                //* :class="trClassBehaviour(book)" v-for="book, no in booksData"
                //* let sumClass = book.state.toLowerCase() == 'empty' ? 'cursor-pointer hover:border-slate-500 hover:bg-slate-500 hover:text-slate-100 hover:text-base' : '';
                const el = event.target.parentNode;
                const pickToTrueClass = (_book, _el) => {
                    _book.pick = true;
                    _el.classList.remove('bg-white',);
                    _el.classList.add('bg-slate-500', 'text-slate-100');
                }
                const pickToFalseClass = (_book, _el) => {
                    _book.pick = false;
                    _el.classList.add('bg-white');
                    _el.classList.remove('bg-slate-500', 'text-slate-100');
                }

                if (book.pick == false) {
                    pickToTrueClass(book, el);
                }
                else if (book.pick == true) {
                    pickToFalseClass(book, el);
                }

                // area logic condition
                if (this.area.length <= 0) {
                    this.area.push({ el: el, book: book });
                }
                else if (this.area.length == 1) {
                    if (this.area[0]) {
                        if (this.area[0].el.id != el.id) {
                            console.log(this.area)
                            this.area.push({ el: el, book: book });
                        }
                    }
                }
                else if (this.area.length >= 2) {
                    this.booksData.forEach((eachBook, no) => {
                        if (eachBook.state.toLowerCase() == 'empty') {
                            const eachId = document.getElementById('id-book-' + no);
                            pickToFalseClass(eachBook, eachId);
                        }
                    });
                    this.area = [];

                    pickToFalseClass(book, el);
                }

                if(this.area.length == 2) {
                    const extractNumberId = (_el) => {

                        let number = String(_el.id).split('-');
                        number = parseInt(number[2]);
                        // console.log(number);
                        return number
                    }
                    const num1 = extractNumberId(this.area[0].el);
                    const num2 = extractNumberId(this.area[1].el);
                    let startIndex = num1;
                    let length = num2;
                    if(num1 > num2) {
                        startIndex = num2;
                        length = num1;
                    }

                    for (let index = startIndex; index < length; index++) {
                        const el = document.getElementById(`id-book-${index}`);
                        pickToTrueClass(this.booksData[index],el);
                        // pickToTrueClass({book:true},el);
                    }

                }
            }
        },
        coloringStatus(state) {
            const lowerCaseState = state.toLowerCase();
            switch (lowerCaseState) {
                case 'pending':
                    return ['text-yellow-400']
                case 'booked':
                    return ['text-blue-400']
                case 'empty':
                    return ['text-green-400']
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
        computedErrors() {
            return JSON.parse(this.errors);
        },
        sortArea() {
            let area = this.area;
            // console.log('%c area', 'color: orange', area);
            if (this.area.length != 0)
                for (let index = 1; index < this.area.length; index++) {
                    if (parseInt(this.area[index - 1].book.time_book_start) > parseInt(this.area[index].book.time_book_start)) {
                        const temp = { ...this.area[index - 1] };
                        area[0] = { ...this.area[index] };
                        area[1] = temp;
                    }
                }
            return area;
        },

        computedCourt() {
            return JSON.parse(this.court);
        },
        // computedBooks() {
        // const books = this.books.data.filter((book) => {
        //     if (this.state.toLowerCase() == 'all') return true;
        //     if (book.state.toLowerCase() == this.state.toLowerCase()) return true;
        // });
        //     let books = JSON.parse(this.books);
        //     books.map((b)=> {
        //         b.pick = false;
        //         return b;
        //     });
        //     return books;
        // }
    },
}
</script>

<style lang="scss" scoped>

</style>
