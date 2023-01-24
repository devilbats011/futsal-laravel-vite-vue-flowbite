<template>
    <main>



        <!-- {{dataCourt.id}} -->
        <div class="overflow-x-auto relative mt-5  rounded">
                   <!-- xxx-->
        <ol
            class="flex items-center w-full text-sm font-semibold text-center text-gray-500 dark:text-gray-400 sm:text-base">
            <li
                class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                <!-- <div> -->
                    <span
                        class="flex items-center after:content-['/'] sm:after:hidden  after:font-light after:text-gray-200 dark:after:text-gray-500">
                        <!-- <svg aria-hidden="true" class="w-5 h-5 mx-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg> -->
                        <span class="mr-2">1</span>
                        Booking  <span class="hidden sm:inline-flex sm:ml-2"> Time</span>
                    </span>
                <!-- </div> -->
            </li>
            <li
                class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-3 xl:after:mx-10 dark:after:border-gray-700">
                <span
                    class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                    <span class="mr-2">2</span>
                    Account <span class="hidden sm:inline-flex sm:ml-2">Info</span>
                </span>
            </li>
            <li class="flex items-center">
                <span class="mr-2">3</span>
                Confirmation
            </li>
        </ol>
        <!-- xxx -->
            <br>
            Errors:
            {{ errors }}
            <div class="mb-3 flex gap-x-4">
                <h1 class="text-lg relative top-[.5rem]"> Book Court {{ computedCourt.number }} Avaibility </h1>
                <form action="" class="flex gap-x-2">
                    <label class="relative top-2">
                        <p>Date:</p>
                    </label>
                    <input v-model="date" type="date" name="book_date" id="book_date" class="rounded"
                        ref="ref_book_date" required @change="changeBookDate">
                    <!--  class="border rounded px-2 " -->
                    <input type="submit"
                        class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        value="Submit Date" hidden ref="refSubmitBookCourtDate">
                </form>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 border border-gray-200">
                    <tr>
                        <!-- ,'Detail''Pick', -->
                        <th scope="col" class="py-3 px-6" v-for="th in ['No', 'Time Start', 'Time End', 'Status']">
                            {{ th }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- dark:bg-gray-800 dark:border-gray-700 -->
                    <tr class="border bg-white" :class="trClassBehaviour(book)" v-for="book, no in booksData"
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
            <input type="hidden" name="court_id" :value="dataCourt.id" />
            <input type="hidden" name="device" id="device" :value="device" />

            <div class="relative z-0 mb-6 w-full group">
                <input type="date" name="book_date" id="book_date"
                    class="select-none block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    required ref="refDate" v-model="date" readonly />
                <!-- disabled -->
                <!-- ? https://stackoverflow.com/questions/1355728/values-of-disabled-inputs-will-not-be-submitted -->
                <label for="book_date"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Date Booking
                </label>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <input type="number" name="time_book_start" min="9" max="24" id="floating_company"
                        class="select-none block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " v-model="time_book_start" required readonly />
                    <!-- disabled -->
                    <!-- ? https://stackoverflow.com/questions/1355728/values-of-disabled-inputs-will-not-be-submitted -->
                    <!-- v-model="sortArea[0]?.book?.time_book_start" :value="sortArea[0]?.book?.time_book_start" -->
                    <label for="time_book_start"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Time Start (24 Hour System)
                    </label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="number" name="time_book_end" min="9" max="24" id="floating_company"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " v-model="time_book_end" required readonly />
                    <!-- disabled -->
                    <!-- ? https://stackoverflow.com/questions/1355728/values-of-disabled-inputs-will-not-be-submitted -->
                    <!-- :value="sortArea[1]?.book?.time_book_end ?? sortArea[0]?.book.time_book_end" -->
                    <!-- v-model="sortArea[1]?.book?.time_book_end ?? sortArea[0]?.book.time_book_end" -->
                    <label for="time_book_end"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Time End (24 Hour System)
                    </label>

                </div>
            </div>

            <div class="pb-3">
                <p class="font-normal text-xs relative bottom-[5px]">
                    ~ Time Booking (Time Start - Time End) Between 9-24 (24 hour system) ~
                </p>
            </div>

            <div class="relative z-0 my-6 w-full group">
                <input type="text" name="total_hour" id="total_hour"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " disabled v-model="total_hour" />
                <label for="total_hour"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Total
                    Hour</label>
            </div>

            <div class="relative z-0 my-10 w-full group">
                <input type="text" name="name" id="name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required v-model="name" />
                <!-- :value="oldName" -->
                <label for="name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-[0.2px] -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
            </div>
            <div class="relative z-0 my-10 w-full group">
                <input type="email" name="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " v-model="email" />
                <!-- type="email" required  :value="" -->
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-[0.2px] -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
            </div>
            <div class="relative z-0 my-10 w-full group">
                <input type="tel" name="phone_no" id="phone_no"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required v-model="phoneNo" />
                <!-- :value="oldPhoneNo" -->
                <label for="phone_no"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-[0.2px] -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
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

        this.name = this.oldName ?? '?-?';
        console.log(typeof this.oldEmail, this.oldEmail == '');

        //* Mount User, Name, Phone ,Email
        if (this.user) {
            this.dataUser = JSON.parse(this.user);
            this.name = this.oldName ? this.oldName : this.dataUser.name;
            this.phoneNo = this.oldPhoneNo ? this.oldPhoneNo : this.dataUser.phone_no;
            this.email = this.oldEmail ? this.oldEmail : this.dataUser.email;
        }
        else {
            // console.log('%c this.user == ""','color: orange',this.user == "");
            this.name = this.oldName;
            this.email = this.oldEmail;
            this.phoneNo = this.oldPhoneNo;
        }

        //* Mount device
        this.device = window.navigator.userAgent;

        //* Mount date
        this.date = this.book_date ? this.book_date : moment(new Date()).format('yyyy-MM-D');

        //* Mount dataCourt
        this.dataCourt = JSON.parse(this.court);

        //* Mount books
        let books = JSON.parse(this.books);
        books.map((b) => {
            if (b.state.toLowerCase() != 'empty')
                b.pick = '';
            else
                b.pick = false;
            return b;
        });
        this.booksData = books;

        // console.log(moment().format('D-mm-yyyy'));
        // this.$refs.refDate.valueAsDate = new Date();
        // const date = this.$refs.ref_book_date;
        // date.valueAsDate = this.book_date ? new Date(this.book_date) : new Date();
    },
    data() {
        return {
            name: '',
            phoneNo: '',
            email: '',
            dataCourt: {},
            time_book_start: null,
            time_book_end: null,
            total_hour: 0,
            date: '',
            device: '',
            booksData: [],
            area: [],
            states: ['All', 'Pending', 'Booked', 'Empty'],
            state: 'All',
            dataUser: null,
        }
    },
    props: {
        oldPhoneNo: {
            type: String,
            default: ''
        },
        oldName: {
            type: String,
            default: ''
        },
        oldEmail: {
            type: String,
            default: ''
        },
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
        court: {
            type: String,
            default: ''
        },
        user: {
            type: String,
            default: ''
        },
    },
    methods: {
        changeBookDate() {
            const submit = this.$refs.refSubmitBookCourtDate;
            submit.click();
        },
        trClassBehaviour(book) {
            // hover:bg-slate-700 hover:text-slate-100   border-t hover:border-slate-500
            let sumClass = book.state.toLowerCase() == 'empty' ? 'cursor-pointer hover:text-base bg-white border border-b' : 'bg-slate-50';
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
                    _el.classList.add('bg-slate-700', 'text-slate-100', 'border-gray-700');
                }

                const pickToFalseClass = (_book, _el, option = null) => {

                    if (option) {
                        if (option.hoverOff) {
                            //'hover:bg-slate-700', 'hover:text-slate-100', 'hover:border-slate-500',
                            _el.classList.remove('hover:text-base');
                            setTimeout(() => {
                                //'hover:bg-slate-700', 'hover:text-slate-100', 'hover:border-slate-500',
                                _el.classList.add('hover:text-base');
                            }, 1700);
                        }

                        // just incase...
                        if (option.hoverOn) {
                            //'hover:bg-slate-700', 'hover:text-slate-100', 'hover:border-slate-500',
                            _el.classList.add('hover:text-base');
                        }
                    }

                    _book.pick = false;
                    _el.classList.add('bg-white');
                    _el.classList.remove('bg-slate-700', 'text-slate-100', 'border-gray-700');
                }

                const clearHoursAndTimeStartEnd = () => {
                    this.total_hour = 0;
                    this.time_book_start = null;
                    this.time_book_end = null;
                }

                const clearAllEmptyArea = () => {
                    this.booksData.forEach((eachBook, no) => {
                        if (eachBook.state.toLowerCase() == 'empty') {
                            const eachId = document.getElementById('id-book-' + no);
                            pickToFalseClass(eachBook, eachId, { hoverOn: true });
                        }
                    });
                    this.area = [];
                    // console.log(book);
                    clearHoursAndTimeStartEnd();
                    pickToFalseClass(book, el);
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
                    this.total_hour = 1;
                    this.$nextTick(() => {
                        this.time_book_start = parseInt(book.time_book_start);
                        this.time_book_end = parseInt(book.time_book_end);
                    });
                }
                else if (this.area.length == 1) {

                    if (this.area[0]) {

                        this.area.push({ el: el, book: book });
                        // if (this.area[0].el.id != el.id) {
                        // console.log(this.area)
                        // this.area.push({ el: el, book: book });
                        // }
                        if (this.area[0].el.id == el.id) {
                            //* when user click the same area
                            clearHoursAndTimeStartEnd();
                            if (this.area[0].el.id == this.area[1].el.id) {
                                pickToFalseClass(book, el, { hoverOff: true });
                                this.area = [];
                            }
                            else {
                                // this.area.pop();
                                pickToFalseClass(book, el);
                            }
                        }
                    }
                }
                else if (this.area.length >= 2) {
                    clearAllEmptyArea();

                }

                if (this.area.length == 2) {
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

                    if (num1 > num2) {
                        startIndex = num2;
                        length = num1;
                        this.area
                    }

                    this.total_hour = (length - startIndex) + 1;

                    let isBreak = false;
                    for (let index = startIndex; index < length; index++) {
                        const _el = document.getElementById(`id-book-${index}`);

                        const _book = this.booksData[index];
                        if (_book.state != 'empty') {
                            // console.log('helle-not-empty');
                            clearAllEmptyArea();
                            isBreak = true;
                            break;
                        }

                        pickToTrueClass(_book, _el);
                        // pickToTrueClass({ book: true }, el);
                    }

                    if (isBreak) return;
                    // let sortedArea = this.area;
                    // if (this.area.length != 0) {
                    // for (let index = 1; index < this.area.length; index++) {
                    if (parseInt(this.area[0].book.time_book_start) > parseInt(this.area[1].book.time_book_start)) {
                        // sortedArea[0] = { ...this.area[1] };
                        // sortedArea[1] = { ...this.area[0] };
                        this.$nextTick(() => {
                            this.time_book_start = this.area[1].book.time_book_start;
                            this.time_book_end = this.area[0].book.time_book_end;
                        });
                    }
                    else {
                        this.$nextTick(() => {
                            this.time_book_start = this.area[0].book.time_book_start;
                            this.time_book_end = this.area[1].book.time_book_end;
                        });
                    }
                    // }
                    // }
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
    // watch: {
    //  area(v) {
    //  console.log('%c v', 'color: orange', v);
    //  }
    //},
}
</script>

<style lang="scss" scoped>

</style>
