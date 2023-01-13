        {{-- <a  class="px-4">  </a> --}}
        <a href="/"
            class="relative inline-flex items-center justify-center p-0.5 my-2 ml-5 mr-1 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
            <span
                class="relative px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                HOME
            </span>
        </a>
        @guest
            <a href="{{ route('login') }}" class="px-4"> Login </a>
            <a href="{{ route('register') }}" class="pl-2 pr-4"> Register </a>
        @endguest
        @auth
            @if (auth()->user()->role == 'admin')
                <a href="{{ route('admin.home') }}" class="px-4"> ADMIN: {{ auth()->user()->name }}
                </a>
            @endif
            <a href="{{ route('home') }}" class="px-4"> {{ auth()->user()->name }} </a>
            <a href="{{ route('logout') }}" class="px-4 text-medium"
                onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                Logout
            </a>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endauth
