<template>
    <main>

        <div class="overflow-x-auto relative mt-5  rounded" id="default-carousel" data-carousel="static">
            <!-- * stepper -->
            <!--* Slider indicators -->
            <!-- {{ this.carouselActiveItem.position }} -->
            <!-- class="mr-2 md:mr-auto cursor-pointer flex md:w-full items-center  sm:after:content-[''] after:w-full after:h-1  after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700"> -->
            <ol class="pb-8 px-5 flex items-center w-full text-xs font-semibold text-center sm:text-base "
                id="stepper-parent">
                <!-- data-carousel-slide-to="0"  -->
                <li id="carousel-indicator-1" @click="()=>{carousel.slideTo(0);goScrollTop()}"
                    class="cursor-pointer flex md:w-full items-center text-gray-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700 after:transition-all transition-all">
                    <!-- <div> -->
                    <span
                        class="border hover:border-slate-300 border-transparent rounded-md p-1 flex items-center after:content-['/'] md:after:hidden  after:mx-1 after:font-light after:text-gray-500 dark:after:text-gray-500">
                        <!-- <svg aria-hidden="true" class="w-5 h-5 mx-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg> -->
                        <span class="mr-2">1</span>
                        Booking <span class="hidden sm:inline-flex sm:ml-2"> Time</span>
                    </span>
                    <!-- </div> -->
                </li>
                <!-- data-carousel-slide-to="1" -->
                <li id="carousel-indicator-2" @click="submitHandler"
                    class="cursor-pointer text-gray-500 flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-3 xl:after:mx-10 dark:after:border-gray-700 after:transition-all transition-all">
                    <span
                        class="border hover:border-slate-300 border-transparent rounded-md p-1 flex items-center after:content-['/'] md:after:hidden after:mx-2 after:font-light after:text-gray-500 dark:after:text-gray-500">
                        <span class="mr-2">2</span>
                        <!-- Account <span class="hidden sm:inline-flex sm:ml-2">Info</span> -->

                        <span class=" sm:inline-flex  ml-2"> Fill </span>
                        <!-- <span class=" sm:inline-flex ml-2"> Up </span> -->
                        <span class=" sm:inline-flex ml-2"> Info</span>
                    </span>
                </li>
                <!--  data-carousel-slide-to="2" -->
                <li class="cursor-pointer text-gray-500 flex items-center transition-all" id="carousel-indicator-3">
                    <span class="border hover:border-slate-300 border-transparent rounded-md p-1 flex">
                        <span class="mr-2">3</span>
                        Confirmation
                    </span>
                </li>
            </ol>
            <!-- * stepper  -->



            <!-- start-carousel -->
            <!-- <div id="default-carousel" class="relative" data-carousel="static"> -->
            <div class="relative">

                <!-- <div class="pb-3 px-3 pt-6 flex gap-2 flex-col sm:flex-row border rounded-md mb-3">

               3 buttons

                </div> -->

                <div ref="refTimesIntersector"> </div>
                <div class="pb-3 px-3 pt-6 flex gap-3 flex-col sm:flex-row border rounded-md bg-slate-200 mb-3 transition-all"
                    ref="refTimes">

                    <form action="" class="flex gap-x-2 mr-2 mb-3">
                        <label class="relative top-[10px]">
                            <p class="font-medium text-xs md:text-lg">Date:</p>
                        </label>
                        <input v-model="date" type="date" name="book_date" id="book_date" class="rounded"
                            ref="ref_book_date" required @change="changeBookDate">
                        <!--  class="border rounded px-2 " -->
                        <input type="submit"
                            class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            value="Submit Date" hidden ref="refSubmitBookCourtDate">
                    </form>

                    <section class="gap-x-4 pt-1.5 flex flex-wrap text-xs md:text-lg font-base">
                        <div>
                            Total Hours: <span class="rounded px-3 py-1 bg-slate-100 font-semibold"> {{
                                this.total_hour
                            }}</span>
                        </div>
                        <div>
                            Time Duration : <span class="rounded px-3 py-1 bg-slate-100 font-semibold">
                                {{ totalDuration() }}
                            </span>
                        </div>
                    </section>
                    <button type="button" v-if="carouselActiveItem.position <= 2 && carouselActiveItem.position > 0"
                        @click="backSubmit"
                        class="relative w-fit bottom-[2px] text-sm px-3 py-3 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-xl text-center mb-2">
                        <span class="flex gap-x-1">
                            <svg fill="none" stroke="currentColor" stroke-width="3.5" viewBox="0 0 24 24"
                                class="rotate-[180deg] w-4 h-4 relative top-[2px]" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                            </svg>
                            <span>Back</span>
                        </span>

                    </button>
                    <!-- SUBMIT-BLUE NEXT 1 -->
                    <button type="button" @click="submitHandler" v-if="carouselActiveItem.position == 0"
                        class=" relative w-fit bottom-[2px] text-sm px-3 py-3 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-xl text-center mb-2">
                        <span class="flex gap-x-1">
                            <span> Next </span>
                            <svg fill="none" stroke="currentColor" stroke-width="3.5" viewBox="0 0 24 24"
                                class="w-4 h-4 relative top-[2px]" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                            </svg>
                            <span> 2 </span>
                        </span>
                    </button>
                    <!-- SUBMIT-BLUE NEXT 2  -->

                    <button type="button" @click="submitHandler2" v-if="carouselActiveItem.position == 1"
                        class=" relative w-fit bottom-[2px] text-sm px-3 py-3 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-xl text-center mb-2">
                        <span class="flex gap-x-1">
                            <span> Next </span>
                            <svg fill="none" stroke="currentColor" stroke-width="3.5" viewBox="0 0 24 24"
                                class="w-4 h-4 relative top-[2px]" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                            </svg>
                            <span> 3 </span>
                        </span>
                    </button>
                    <!-- confirm-next NEXT 3 -->
                    <button type="button" v-if="carouselActiveItem.position == 2" @click="showConfirmModal"
                        class="relative w-fit bottom-[2px] text-sm px-3 py-3 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-xl text-center mb-2">
                        <span class="flex gap-x-1">
                            <span>Confirm </span>
                            <svg class="w-4 h-4 relative top-[2.5px]" stroke-width="3.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                            </svg>


                        </span>

                    </button>

                </div>

                <!--! errors  -->
                <section v-if="dataErrors.length > 0 || errorsFromServer.length > 0"
                    class="p-2 mb-1 flex gap-1 flex-col transition-all">

                    <div v-if="errorsFromServer.length > 0"
                        class="w-full flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg"
                        ref="refErrorsFromServer" role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only"> Errors:</span>
                        <div>
                            <span class="font-medium">There some error while submitting:</span>
                            <ul class="mt-1.5 ml-4 list-disc list-inside" v-for="e in errorsFromServer">
                                <li> {{ e }} </li>
                            </ul>
                        </div>
                    </div>

                    <div v-if="dataErrors.length > 0"
                        class="w-full flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg"
                        ref="refErrors" role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only"> Errors:</span>
                        <div>
                            <span class="font-medium">Change a few things up and try again:</span>

                            <ul class="mt-1.5 ml-4 list-disc list-inside" v-for="error in dataErrors">

                                <li> {{ error }} </li>
                            </ul>
                        </div>

                    </div>

                </section>
                <!--! errors -->

                <!-- Carousel wrapper -->
                <div class="relative border h-[1050px] rounded-lg overflow-y-scroll overflow-x-hidden" ref="refCarouselWrapper">
                    <!-- Item 1 -->
                    <section class="hidden duration-400 ease-in-out md:p-5 overflow-scroll" data-carousel-item
                        id="carousel-item-1">
                        <div class="my-3 flex gap-4 flex-col ">
                            <h1 class="text-lg sm:text-3xl relative font-semibold text-blue-600 px-2 space-x-3">
                                <span class="border-2 border-blue-600 py-1 px-3 rounded-full relative top-[1px]">
                                    <span class="relative left-[3px]">
                                        1
                                    </span>
                                </span>
                                <span> Booking Time</span>
                            </h1>
                            <h3 class="text-xl relative font-semibold text-gray-700 p-2">
                                Click 1 Column or 2 Column to Book Times
                            </h3>
                        </div>

                        <!-- start-table-time-book-court -->
                        <table class="relative w-full  text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-slate-300  border border-gray-200">
                                <tr>
                                    <th scope="col" class="py-3 px-6"
                                        v-for="th in ['No', 'Time Start', 'Time End', 'Status']">
                                        {{ th }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- dark:bg-gray-800 dark:border-gray-700 -->
                                <tr class="border bg-white" :class="trClassBehaviour(book)"
                                    v-for="book, no in booksData" @click="(event) => clickBook(book, event)"
                                    :id="'id-book-' + no">
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
                        <!-- end-table-time-book-court -->
                    </section>
                    <!-- Item 2 -->
                    <section class="hidden duration-400 ease-in-out p-5" data-carousel-item id="carousel-item-2">

                        <div class="my-3 flex gap-4 flex-col">
                            <h1 class="text-lg sm:text-3xl relative font-semibold text-blue-600 px-2 space-x-3">
                                <span class="border-2 border-blue-600 py-1.5 px-3 rounded-full relative top-[1px]">
                                    <span class="relative left-[3px]">
                                        2
                                    </span>
                                </span>
                                <span> Fill Info </span>
                            </h1>

                        </div>

                        <!--* inputs-form  -->
                        <form class="relative mt-5 p-5" method="POST" :action="routeAction">
                            <input type="hidden" name="_token" :value="csrf" />
                            <input type="hidden" name="court_id" :value="dataCourt.id" />
                            <input type="hidden" name="device" id="device" :value="device" />

                            <!-- <div class="relative z-0 mb-6 w-full group"> -->
                            <input type="date" name="book_date" id="book_date" required ref="refDate" v-model="date"
                                hidden readonly />
                            <!-- disabled -->
                            <!-- ? https://stackoverflow.com/questions/1355728/values-of-disabled-inputs-will-not-be-submitted -->
                            <!-- <label for="book_date"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Date Booking
                                </label> -->
                            <!-- </div> -->

                            <!-- <div class="grid md:grid-cols-2 md:gap-6"> -->
                            <!-- <div class="relative z-0 mb-6 w-full group"> -->
                            <input type="number" name="time_book_start" min="9" max="24" id="time_book_start"
                                placeholder=" " v-model="time_book_start" required hidden readonly />
                            <!-- disabled -->
                            <!-- ? https://stackoverflow.com/questions/1355728/values-of-disabled-inputs-will-not-be-submitted -->
                            <!-- v-model="sortArea[0]?.book?.time_book_start" :value="sortArea[0]?.book?.time_book_start" -->
                            <!-- <label for="time_book_start"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Time Start (24 Hour System)
                                    </label> -->
                            <!-- </div> -->
                            <!-- <div class="relative z-0 mb-6 w-full group"> -->
                            <input type="number" name="time_book_end" min="9" max="24" id="time_book_end"
                                placeholder=" " v-model="time_book_end" required readonly hidden />
                            <!-- disabled -->
                            <!-- ? https://stackoverflow.com/questions/1355728/values-of-disabled-inputs-will-not-be-submitted -->
                            <!-- :value="sortArea[1]?.book?.time_book_end ?? sortArea[0]?.book.time_book_end" -->
                            <!-- v-model="sortArea[1]?.book?.time_book_end ?? sortArea[0]?.book.time_book_end" -->
                            <!-- <label for="time_book_end"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Time End (24 Hour System)
                                    </label> -->

                            <!-- </div> -->
                            <!-- </div> -->

                            <!-- <div class="pb-3">
                                <p class="font-normal text-xs relative bottom-[5px]">
                                    ~ Time Booking (Time Start - Time End) Between 9-24 (24 hour system) ~
                                </p>
                            </div> -->

                            <!-- <div class="relative z-0 my-6 w-full group"> -->
                            <input type="text" name="total_hour" id="total_hour" placeholder=" " disabled
                                v-model="total_hour" hidden />
                            <!-- <label for="total_hour"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Total
                                    Hour</label> -->
                            <!-- </div> -->

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

                            <button type="submit" ref="refFillInfoSubmit" hidden
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>
                    </section>
                    <!-- Item 3 -->
                    <section class="hidden duration-400 ease-in-out p-5" data-carousel-item id="carousel-item-3">
                        <div class="my-3 flex gap-4 flex-col ">
                            <h1 class="text-lg sm:text-3xl relative font-semibold text-blue-600 px-2 space-x-3">
                                <span class="border-2 border-blue-600 py-1.5 px-3 rounded-full relative top-[1px]">
                                    <span class="relative left-[3px]">
                                        3
                                    </span>
                                </span>
                                <span> Confirmation </span>
                            </h1>
                            <section class="mt-5 text-xs sm:text-base space-y-2 overflow-auto">
                                <table class="table-confirm border rounded-lg w-full md:w-11/12">
                                    <tr>
                                        <td>Name:</td>
                                        <td>{{ name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td>{{ email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone No:</td>
                                        <td>{{ phoneNo }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date:</td>
                                        <td>{{ date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Court No:</td>
                                        <td>{{ dataCourt.number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Court floor:</td>
                                        <td>{{ dataCourt.type_floor }}</td>
                                    </tr>
                                    <tr>
                                        <td>Rm/Hour:</td>
                                        <td>{{ dataCourt.hour_rate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total hour:</td>
                                        <td>{{ total_hour }}</td>
                                    </tr>
                                    <tr>
                                        <td>Start Time:</td>
                                        <td>{{ $convertTo12hoursFormat(time_book_start) }}</td>
                                    </tr>
                                    <tr>
                                        <td>End Time:</td>
                                        <td>{{ $convertTo12hoursFormat(time_book_end) }}</td>
                                    </tr>
                                </table>

                            </section>
                        </div>

                        <!-- <div class=" text-center">
                            <button @click="showConfirmModal" class="border rounded-lg p-2"> Confirm Booking? </button>
                        </div> -->
                        <!-- <img src="http://localhost:8000/futsal-logo.jpg"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> -->
                    </section>
                </div>


            </div>

            <!-- end-carousel -->



        </div>


        <!-- Main modal data-modal-backdrop="static" -->
        <div id="popux-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        @click="hideConfirmModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center space-y-3">
                        <svg aria-hidden="true" class="mx-auto mb-4 mt-6 text-blue-600 w-16 h-16 dark:text-blue-600"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="pb-3 text-lg font-normal text-gray-500 dark:text-gray-400">
                            Confirm?
                        </h3>
                        <section class="text-xs sm:text-base space-y-2 overflow-auto my-4">
                            <table class="table-confirm border rounded-lg">
                                <tr>
                                    <td>Name:</td>
                                    <td>{{ name }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{ email }}</td>
                                </tr>
                                <tr>
                                    <td>Phone No:</td>
                                    <td>{{ phoneNo }}</td>
                                </tr>
                                <tr>
                                    <td>Date:</td>
                                    <td>{{ date }}</td>
                                </tr>
                                <tr>
                                    <td>Court No:</td>
                                    <td>{{ dataCourt.number }}</td>
                                </tr>
                                <tr>
                                    <td>Court floor:</td>
                                    <td>{{ dataCourt.type_floor }}</td>
                                </tr>
                                <tr>
                                    <td>Rm/Hour:</td>
                                    <td>{{ dataCourt.hour_rate }}</td>
                                </tr>
                                <tr>
                                    <td>Total hour:</td>
                                    <td>{{ total_hour }}</td>
                                </tr>
                                <tr>
                                    <td>Start Time:</td>
                                    <td>{{ $convertTo12hoursFormat(time_book_start) }}</td>
                                </tr>
                                <tr>
                                    <td>End Time:</td>
                                    <td>{{ $convertTo12hoursFormat(time_book_end) }}</td>
                                </tr>
                            </table>

                        </section>
                        <div class="h-1"></div>
                        <button data-modal-hide="popux-modal" type="button" @click="submitHandler3"
                            class=" text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure!
                        </button>
                        <button @click="hideConfirmModal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Back
                        </button>
                        <div class="h-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</template>

<script>
import moment from 'moment';
import isEmail from 'validator/lib/isEmail';

export default {
    mounted() {

        //* Mount errors
        const jsonErrors = JSON.parse(this.errors);
        const errorsUnflat = Object.values(jsonErrors);
        this.errorsFromServer = errorsUnflat.flat();

        // console.log('%c this.dataErrors--','color: orange',Object.entries(this.dataErrors).flat(Infinity));


        //* mounted sticky element
        const el = this.$refs.refTimesIntersector;
        const timesEl = this.$refs.refTimes;

        //? https://css-tricks.com/how-to-detect-when-a-sticky-element-gets-pinned/
        // document.addEventListener('scroll', (event) => {
        const observer = new IntersectionObserver(
            ([e]) => {
                // console.log("is-pinned?", e.intersectionRatio < 1);
                el.classList.toggle("h-[96px]", e.intersectionRatio < 1);
                timesEl.classList.toggle("pinned", e.intersectionRatio < 1);
            },
            { threshold: [1] }
        );
        observer.observe(el);
        // });

        // * Mount Carousel
        const items = [
            {
                position: 0,
                el: document.getElementById('carousel-item-1')
            },
            {
                position: 1,
                el: document.getElementById('carousel-item-2')
            },
            {
                position: 2,
                el: document.getElementById('carousel-item-3')
            }
        ];

        const options = {
            interval: 1000,
            indicators: {
                // activeClasses: 'text-blue-600 dark:text-blue-500',
                // inactiveClasses: 'text-gray-500 dark:text-gray-400',
                items: [
                    // {
                    //     position: 0,
                    //     el: document.getElementById('carousel-indicator-1')
                    // },
                    // {
                    //     position: 1,
                    //     el: document.getElementById('carousel-indicator-2')
                    // },
                    // {
                    //     position: 2,
                    //     el: document.getElementById('carousel-indicator-3')
                    // },
                ]
            },
            onChange: (item) => {
                console.log('%cBook.vue line:48', 'color: #007acc;');
                this.carouselActiveItem = item._activeItem;
            }
        }
        const carousel = new Carousel(items, options);
        this.carousel = carousel;
        // TEST
        // setTimeout(() => {
        //     this.carousel.slideTo(2);
        //     // this.carousel.next();
        // }, 400);

        //* Mount User, Name, Phone ,Email, ...time_book_start, time_book_end _not implement kiv..
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
            errorsFromServer: [],
            verificationArray: [false, false],
            carousel: {},
            carouselActiveItem: { el: {}, position: 0 },
            dataErrors: [],
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
        oldStart: {
            type: String,
            default: ''
        },
        oldEnd: {
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
        backSubmit() {
            this.goScrollTop();
            this.carousel.prev();
        },
        goScrollTop() {

            // const el = this.$refs.refTimesIntersector;
            const el = document.querySelector("#stepper-parent");
            el.scrollIntoView({ behavior: "smooth", block: "start", inline: "start" });
        },
        errorsFlash() {
            const el = this.$refs.refErrors;
            if (el) {
                el.classList.add('errors-bg-color-flash');
                setTimeout(() => {
                    el.classList.remove('errors-bg-color-flash');
                }, 400);
            }
        },
        submitHandler() {
            this.verificationArray[0] = false;
            this.goScrollTop();
            if (this.oneBookingTimeValidation()) {
                this.verificationArray[0] = true;
                // go 2 fill info
                this.carousel.slideTo(1);
                return true;
            }
            return false;

        },
        oneBookingTimeValidation() {
            this.dataErrors = [];
            if (!this.total_hour) {
                this.dataErrors.push("Total Hours/Total Duration can't be Zero");
                // const el = this.$refs.refTimes;
                this.errorsFlash();
                return false;
            }
            return true;
        },
        submitHandler2() {
            this.goScrollTop();
            this.verificationArray[1] = false;
            if (this.twoFillInfoValidation()) {
                this.verificationArray[1] = true;
                // go to confirmation
                this.carousel.slideTo(2);
                return true;
            }
            return false;

        },
        twoFillInfoValidation() {
            this.dataErrors = [];
            let result = true;
            if (!this.name) {
                this.dataErrors.push("Name can't be empty");
                result = false;
            }
            let nameRegex = /^[a-zA-Z' ]+$/;
            let isValidName = nameRegex.test(this.name);
            if (!isValidName) {
                this.dataErrors.push("Something Wrong With Your Name..");
                result = false;
            }
            if (!this.email) {
                this.dataErrors.push("Email can't be empty");
                result = false;
            }
            if (!isEmail(this.email)) {
                this.dataErrors.push("Wrong Email Format");
                result = false;
            }
            if (!this.phoneNo) {
                this.dataErrors.push("Phone Number can't be empty");
                result = false;
            }
            let phoneNumberRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
            let isValidPhoneNumber = phoneNumberRegex.test(this.phoneNo);
            if (!isValidPhoneNumber) {
                this.dataErrors.push("Wrong Phone Number Format");
                result = false;
            }

            if (!result) {
                this.errorsFlash();
            }

            return result;
        },
        submitHandler3() {
            // const isAllVerify = this.verificationArray.every(v => v == true);
            // if(!isAllVerify)
            // console.log('%cBook.vue line:702 this.submitHandler() && this.submitHandler2()', 'color: #007acc;', this.submitHandler() && this.submitHandler2());
            // if(this.submitHandler() && this.submitHandler2()) return;
            // if (this.carouselActiveItem.position == 2) return;
            // this.carousel.slideTo(2);
            const fillInfoSubmitBtn = this.$refs.refFillInfoSubmit;
            fillInfoSubmitBtn.click();
        },
        totalDuration() {
            if (!this.time_book_start) return 0;

            if (!this.time_book_end) return 0;
            return `${this.$convertTo12hoursFormat(this.time_book_start)} - ${this.$convertTo12hoursFormat(this.time_book_end)}`
        },
        showConfirmModal() {
            const targetEl = document.getElementById('popux-modal');

            const options = {
                backdrop: 'static',
                onHide: () => {
                    const backDropEl = document.querySelector('[modal-backdrop]');
                    if (backDropEl) backDropEl.remove();

                },
            };

            const modal = new Modal(targetEl, options);
            modal.show();
        },
        hideConfirmModal() {
            const targetEl = document.getElementById('popux-modal');
            const options = {
                backdrop: 'static',
                onHide: (e) => {
                    const backDropEl = document.querySelector('[modal-backdrop]')
                    if (backDropEl) backDropEl.remove();
                },
            };

            const modal = new Modal(targetEl, options);
            modal.hide();
        },
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
    watch: {
        carouselActiveItem(newValue) {
            console.log('%cBook.vue line:850?? ', 'color: #007acc;',);
            const currentPosition = newValue.position; //* start with 0;
            const sumStepper = document.querySelector('#stepper-parent').children.length;

            for (let index = 0; index < sumStepper; index++) {
                const id = index + 1;
                const el = document.querySelector(`#carousel-indicator-${id}`);
                const beforeEl = document.querySelector(`#carousel-indicator-${index}`);
                console.log('%cBook.vue line:86', 'color:orange;', currentPosition);
                if (index <= currentPosition) {
                    if (beforeEl) {
                        beforeEl.classList.remove('after:border-gray-200');
                        beforeEl.classList.add('after:border-blue-500');
                    }
                    el.classList.remove('text-blue-600', 'text-gray-500');
                    el.classList.add('text-blue-600');
                    continue;
                }
                if (beforeEl) {
                    beforeEl.classList.remove('after:border-blue-500');
                    beforeEl.classList.add('after:border-gray-200');
                }
                el.classList.remove('text-blue-600', 'text-gray-500');
                el.classList.add('text-gray-500');
            }
        }
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
.bg-color-flash {
    animation: anm-errors .4s linear;
    background-color: rgb(226 232 240); //slate-200

    // background-color: rgb(203 213 225); //slate-300
}


.errors-bg-color-flash {
    animation: anm-errors .4s linear;
    background-color: white; //slate-200

    // background-color: rgb(203 213 225); //slate-300

}

@keyframes anm-errors {
    50% {
        background-color: rgb(254 202 202);
    }

    100% {
        background-color: white;
    }
}

@keyframes anm {
    50% {
        background-color: rgb(100 116 139)
    }

    100% {
        background-color: rgb(226 232 240)
    }
}

.play-none {
    animation: none;
}

.play {

    animation-play-state: running;
}

.pinned {
    opacity: .95;
    position: fixed;
    z-index: 30;
    top: .5rem;
    left: 1.2rem;
    right: 1.2rem;
    padding-left: 1rem;
}
</style>
