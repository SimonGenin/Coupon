@extends('layouts.app')

@section('content')


    <map-component inline-template>

        <div >
            <div id="map" class="w-full"></div>

            <div class="absolute pin-t pin-l pin-r m-4">
                <input @keyup.enter="process" type="text" placeholder="Je veux ..." class="w-full p-4 rounded" v-model="search_string">
            </div>

        </div>

    </map-component>

@endsection
