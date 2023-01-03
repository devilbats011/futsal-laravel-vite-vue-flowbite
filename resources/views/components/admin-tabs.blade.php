<div
class="text-sm font-medium text-center text-gray-500  border-gray-200 dark:text-gray-400 dark:border-gray-700">
<ul class="flex flex-wrap -mb-px">

    @foreach ([['Track Book'=>'admin.home'],['Book Table'=> 'admin.sandbox']] as $tab )
    {{-- @foreach ([['Track Book','#']] as $tab ) --}}
        <li class="mr-2">
            <a
             href="{{route($tab[key($tab)])}}"
             class="inline-block p-4 rounded-t-lg border-b-2 {{ $tab[key($tab)] == Route::current()->getName() ? 'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500': 'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'}}  "
             aria-current="page">
                {{key($tab)}}
                {{-- {{$tab[1]}} --}}
                {{-- {{key($tab)}} --}}
            </a>
        </li>
    @endforeach

    {{-- <li class="mr-2">
        <a href="#"

            class="inline-block p-4 rounded-t-lg border-b-2 border-transparent ">Settings</a>
    </li>
    <li class="mr-2">
        <a href="#"
            class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
            Book Table
        </a>
    </li> --}}
    <li class="mr-2">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <button type="submit"
                class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Log Out
            </button>
        </form>
    </li>

</ul>
</div>
