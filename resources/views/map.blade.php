@extends('layouts.app')

@section('content')


    <map-component inline-template :announcements="{{ $announcements }}">



        <div >
            <div id="map" class="w-full"></div>

            <div class="absolute pin-t pin-l pin-r m-4">
                <input @keyup.enter="process" type="text" placeholder="Je veux ..." class="w-full p-4 rounded" v-model="search_string">

                <div v-show="tags_output.length != 0" class="bg-white mt-2  rounded shadow p-4">
                    <span v-for="tag_out in tags_output" class="uppercase font-bold mr-2 text-xs bg-blue-dark px-2 py-1 rounded-sm text-white">@{{ tag_out }}</span>
                </div>

            </div>

        </div>

    </map-component>

@endsection
