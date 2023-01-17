<label for="{{$input}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
    {{ $title }}
</label>
<input type="{{ $type }}" name="{{ $input }}" id="{{ $input }}"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
    placeholder="{{ $placeholder ?? ' ' }}" value="{{ old($input) ? old($input) : $value ?? old($input) }}" autocomplete="{{$input}}" autofocus required>
