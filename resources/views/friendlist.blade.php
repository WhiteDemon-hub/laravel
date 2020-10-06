@extends('layout.template')

@section('title')
    {{"Друзья"}}
@endsection

@section('content')
    <article class="menu">
        <menu-component></menu-component>
    </article>
    <section class="content">
        <friendlist-component></friendlist-component>
    </section>
@endsection