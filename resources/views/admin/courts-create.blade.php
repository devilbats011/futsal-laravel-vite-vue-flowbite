@extends('layouts.play')

@section('content-play')
    <section class="p-5">
        <div>
            @include('components.admin-tabs')
            <hr class="">
            {{-- <section class="px-6 pt-4">
                @include('components.breadcrumbs')
            </section> --}}
            <section class="border m-5 rounded">
                <h1 class="text-lg py-3 text-white font-medium text-center bg-blue-700 rounded-t">
                    Create Court
                </h1>
                @include('components.errors')
                <form action="{{route('courts.store')}}" method="POST" class="p-7" >
                    @csrf
                    @include('components.form-input', ['title' => 'Court Number','type' => 'number','input' => 'number'])
                    @include('components.form-input', ['title' => 'Type Floor','type' => 'text','input' => 'type_floor'])
                    @include('components.form-input', ['title' => 'Hour Rate (RM)','type' => 'number','input' => 'hour_rate'])
                    @include('components.form-button-submit', ['name' => 'Create Court'])
                </form>
            </section>
        </div>
    </section>
@endsection

