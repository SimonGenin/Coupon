@extends('layouts.app')

@section('content')

    <nav class="flex items-center m-4">
        <img class="w-1/4 mr-4" src="{{ asset("img/logo.png") }}" alt="">
        <h1 class="text-xl">Les meilleures annonces</h1>
    </nav>


    <div class="bg-white rounded m-2 shadow text-black p-4">

        <h4 class="mb-2">Une bière gratuite jusqu'a 18h</h4>

        <div class="flex justify-between items-center">

            <div class="text-xs text-grey-dark">

            <h6  class="text-xs mb-1" >Le Monde à l'envers</h6>
            <h6  class="text-xs">500m</h6>

            </div>
            <div>
                <span class="uppercase font-bold text-xs bg-blue-dark px-2 py-1 rounded-sm text-white">bar</span>
                <span class="uppercase font-bold text-xs bg-red-dark px-2 py-1 rounded-sm text-white">apero</span>
            </div>
        </div>

    </div>

    <!--
    <div class="bg-white rounded m-2 shadow text-black p-4">

        <h4 class="mb-3">Une bière gratuite jusqu'a 18h</h4>

        <div class="flex justify-between items-center">

            <h6 class="text-sm text-grey-dark">Le Monde à l'envers</h6>

        </div>

        <button class="p-6 bg-blue-dark mt-4 text-white">Click me</button>

    </div>
    -->

@endsection
