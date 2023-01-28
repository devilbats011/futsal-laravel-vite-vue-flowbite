  <!-- Main modal -->
  <div id="booktable-modal" tabindex="-1" aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
      <div class="relative w-full h-full max-w-2xl md:h-auto">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg pt-2 px-2 font-semibold text-gray-900 dark:text-white">
                      Booking Table | Court No.{{$book->court->number}} | Date : {{ $book->book_date }}
                  </h3>
                  <button type="button"
                      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                      data-modal-toggle="booktable-modal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                          xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-6 space-y-6 max-h-[550px] overflow-scroll">

                  {{-- v-for="th in ['No', 'Time Start', 'Time End', 'Status']"> --}}
                  <!-- start-table-time-book-court -->
                  <table class="relative w-full  text-xs text-left text-gray-500 dark:text-gray-400">
                      <thead class="text-xs text-gray-700 uppercase bg-slate-300  border border-gray-200">
                          <tr>
                            @foreach (['No', 'Time Start', 'Time End', 'Status'] as $th)
                            <th scope="col" class="py-3 px-6" >
                                {{ $th }}
                            </th>
                            @endforeach
                          </tr>
                      </thead>
                      <tbody>
                          <!-- dark:bg-gray-800 dark:border-gray-700  v-for="book, no in booksData" -->
                          @foreach ($books as $no => $book)
                          <tr class="border bg-white" >
                              <td class="py-2 px-6 ">
                                <span class="pl-1">
                                    {{ $no + 1 }}
                                </span>
                              </td>
                              <td class="py-2 px-6">
                                  {{ convertTo12hoursFormat($book->time_book_start) }}

                              </td>
                              <td class="py-2 px-6">
                                  {{ convertTo12hoursFormat($book->time_book_end) }}
                              </td>
                              <td class="py-2 px-6 text-base capitalize font-medium {{ $book->state != 'empty' ? 'text-orange-500': 'text-slate-500' }}"  >
                               {{ $book->state }}
                                  {{-- {{ $toUpperCaseFirstLetter($book->state) }} :class="coloringStatus(book.state)" --}}
                              </td>
                          </tr>
                          @endforeach

                      </tbody>
                  </table>
                  <!-- end-table-time-book-court -->





              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

                  <button data-modal-toggle="booktable-modal" type="button"
                      class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
              </div>
          </div>
      </div>
  </div>
