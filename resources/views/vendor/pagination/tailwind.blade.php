@if ($paginator->hasPages())
    <nav class="flex flex-col items-center mt-5" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <span class="text-xs md:text-sm text-gray-700 dark:text-gray-400">
            {!! __('Showing') !!}
            {!! __('results') !!}
            @if ($paginator->firstItem())
                <span class="font-semibold text-gray-900 dark:text-white">
                    {{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-semibold text-gray-900 dark:text-white">
                    {{ $paginator->lastItem() }}
                </span>
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('of') !!}
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ $paginator->total() }}
            </span> Entries
        </span>
        <div class="inline-flex mt-2 xs:mt-0">
            <!-- Buttons -->
            @if ($paginator->onFirstPage())
                <button disabled aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-200 rounded-l dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                    <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Prev
                </button>
            @else
                <a aria-label="{{ __('pagination.previous') }}" href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Prev
                </a>
            @endif
            <div class="mx-[4px]"> </div>
            {{-- xxx --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 border-0 border-l border-gray-100 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Next
                    <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            @else
                <button aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                    disabled
                    aria-label="{{ __('pagination.next') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-200 rounded-l dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                    Next
                    <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            @endif
        </div>
    </nav>
@endif
