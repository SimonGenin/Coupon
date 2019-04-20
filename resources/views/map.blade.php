@extends('layouts.app')

@section('content')


    <map-component inline-template>

        <div >
            <div id="map" class="w-full"></div>

            <div class="absolute pin-t pin-l pin-r m-4">
                <input type="text" placeholder="Je veux ..." class="w-full p-4 rounded">
            </div>

        </div>

    </map-component>

@endsection
