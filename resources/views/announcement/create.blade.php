@extends('layouts.app')

@section('content')

    <create-announcement inline-template>

        <form method="post" action="{{ route('announcement.store') }}">

            {{ csrf_field() }}

            <nav class="flex items-center m-4">
                <img class="w-1/4 mr-4" src="{{ asset("img/logo.png") }}" alt="">
                <h1 class="text-xl">Créez une annonce</h1>
            </nav>

            <div class="bg-white shadow rounded p-4">

                <div class="flex flex-col mb-4">
                    <label class="mb-2" for="title">Titre *</label>
                    <input class="p-2 bg-grey-lighter rounded" type="text" id="title" name="title" required>
                </div>

                <div class="flex flex-col mb-4">
                    <label class="mb-2" for="title_premium">Titre premium *</label>
                    <input class="p-2 bg-grey-lighter rounded" type="text" id="title_premium" name="title_premium"
                           required>
                </div>

                <div class="flex flex-col mb-4">
                    <label class="mb-2" for="description">Description</label>
                    <textarea class="p-2 bg-grey-lighter rounded" type="text" id="description" name="description"
                              rows="6"></textarea>
                </div>

                <div class="mb-4 mt-8">
                    <span class="mb-4">@{{ distance * 10}} metres</span>
                    <input type="hidden" name="distance" v-model="distance">

                    <vue-slider tooltip="none" v-model="distance"/>

                </div>

                <div class="mb-8 mt-8">
                    <span class="mb-4">@{{ time }} minutes</span>
                    <input type="hidden" name="time" v-model="time">
                    <vue-slider tooltip="none" v-model="time"/>
                </div>

                <div class="flex justify-center">

                    <button type="submit"
                            class="py-2 px-4 rounded bg-blue-dark text-white uppercase text-base no-underline">Publier
                        pour @{{ cost }} euros
                    </button>
                </div>

            </div>

        </form>

    </create-announcement>

@endsection
