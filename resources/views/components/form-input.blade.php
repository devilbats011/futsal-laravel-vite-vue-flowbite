<div class="relative z-0 my-9 w-full">
    <input type="{{$type}}" name="{{$input}}" id="{{$input}}"
        value="{{!empty(old($input)) ? old($input) : $value ?? '' }}"
        class=" select-none block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        required
        placeholder=" "
        />
    <!-- disabled -->
    <!-- ? https://stackoverflow.com/questions/1355728/values-of-disabled-inputs-will-not-be-submitted -->
    <label for="{{$input}}"
        class="top-[-3px] -z-10  peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
        {{$title}}
    </label>
</div>
