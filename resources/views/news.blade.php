@extends('layout.template')

@section('title')
    {{"Новости"}}
@endsection

@section('content')
    <article class="menu">
        <menu-component></menu-component>
    </article>
    <section class="content">
        <news-component></news-component>
    </section>
@endsection