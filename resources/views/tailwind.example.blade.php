@extends('layouts.play')

@section('content-play')
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="https://play.tailwindcss.com/img/beams.jpg" alt=""
            class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div
            class="absolute inset-0 bg-[url(https://play.tailwindcss.com/img/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
        </div>
        <div
            class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
            <div class="mx-auto max-w-md">
                <img src="https://play.tailwindcss.com/img/logo.svg" class="h-6" alt="Tailwind Play" />
                <div class="divide-y divide-gray-300/50">

                    <div class="space-y-6 py-8 text-base leading-7 text-gray-600">
                        {{-- https://stackoverflow.com/questions/51366437/best-practice-to-pass-data-from-laravel-to-vue-component --}}
                        <p>An advanced online playground for Tailwind CSS, including support for things like:</p>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4">
                                    Customizing your
                                    <code class="text-sm font-bold text-gray-900">tailwind.config.js</code> file
                                </p>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4">
                                    Extracting classes with
                                    <code class="text-sm font-bold text-gray-900">@apply</code>
                                </p>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 flex-none fill-sky-100 stroke-sky-500 stroke-2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11" />
                                    <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                </svg>
                                <p class="ml-4">Code completion with instant preview</p>
                            </li>
                        </ul>
                        <p>Perfect for learning how the framework works, prototyping a new idea, or creating a demo to share
                            online.</p>
                        <button data-tooltip-target="tooltip-default" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Default
                            tooltip</button>
                        <div id="tooltip-default" role="tooltip"
                            class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                            Tooltip content
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                    <div class="pt-8 text-base font-semibold leading-7">
                        <p class="text-gray-900">Want to dig deeper into Tailwind?</p>
                        <p>
                            <a href="https://tailwindcss.com/docs" class="text-sky-500 hover:text-sky-600">Read the docs
                                &rarr;</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
