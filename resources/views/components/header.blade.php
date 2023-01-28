@if (empty($direction))
    <h1 class="text-3xl font-extrabold dark:text-white">{{ $normal_name ?? '' }} <span
            class=" {{ empty($normal_name) ? 'pl-1' : '' }} text-transparent bg-clip-text bg-gradient-to-r to-cyan-600 from-blue-400">{{ $colored_name }}</span>
    </h1>
@elseif (strtolower($direction) == 'reverse')
    <h1 class="text-3xl font-extrabold dark:text-white"><span
            class=" {{ empty($normal_name) ? 'pr-1' : '' }} text-transparent bg-clip-text bg-gradient-to-r to-cyan-600 from-blue-400">
            {{ $normal_name ?? '' }}
        </span>
        {{ $colored_name }}
    </h1>
    @else
        <h1 class="text-3xl font-extrabold dark:text-white">{{ $normal_name ?? '' }} <span
                class=" {{ empty($normal_name) ? 'pl-1' : '' }} text-transparent bg-clip-text bg-gradient-to-r to-cyan-600 from-blue-400">{{ $colored_name }}</span>
        </h1>
@endif
