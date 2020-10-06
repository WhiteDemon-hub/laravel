@extends('layout.template')

@section('title')
    {{-- {{$user->name." ".$user->Surname }} --}}
    {{$user->name}}
    {{" "}}
    {{$user->Surname}}
@endsection

@section('content')
    <article class="menu">
        <menu-component></menu-component>
    </article>
    <section class="content">
        <userdata-component :user="{{json_encode($user)}}"></userdata-component>
        <posts-component :user="{{json_encode($user)}}"></posts-component>
    </section>
@endsection