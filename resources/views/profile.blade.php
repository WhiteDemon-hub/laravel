@extends('layout.template')

@section('content')
    <div class="user-content">
    <article class="menu">
        <ul>
            <li><a href="">Друзья</a></li>
            <li><a href="">Сообщения</a></li>
            <li><a href="">Новости</a></li>
        </ul>
    </article>
    <section class="content">
        <userdata-component :user="{{json_encode($user)}}"></userdata-component>
        <posts-component :user="{{json_encode($user)}}"></posts-component>
    </section>
    </div>
@endsection