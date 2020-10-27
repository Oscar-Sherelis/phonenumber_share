@extends('layouts.welcome')
@section('phonenumbers')
<div class="phonenumbers-section">
    <div class="phonenumbers-section__content">
        <div class="phonenumbers-section__content__phones">
            <h2>Phonenumbers</h2>
            <form class="add-phone-form" action="/phonenumbers/add" method="POST">
                @error('add')
                    <span class="error">{{$message}}</span>
                @enderror
                <input type="number" name="add" placeholder="Add phonenumber" required>
                <button class="add" type="submit">Add new</button>
                @csrf
            </form>
            <div class="phones">
                @if (\Session::has('success'))
                    <span class="success-message">{!! \Session::get('success') !!}</span>
                @endif
                @error('delete')
                    <span class="error">{{$message}}</span>
                @enderror
                @foreach ($phonenumbers as $phonenumber)
                <div class="phones-from-db">
                    <span>
                        {{ $phonenumber->phonenumber }}
                    </span> 
                    <form action="/phonenumbers/edit" method="GET">
                        <button class="edit" name="edit" value="{{ $phonenumber->id }}">
                            <img src="{{ asset('/images/edit.svg') }}" title="Edit" alt="Edit">
                        </button>
                        @csrf
                    </form>
                    <form action="phonenumbers/delete" method="POST">
                        <button name="delete" value="{{ $phonenumber->id }}" type="submit">
                            <img src="{{ asset('/images/del.svg') }}" title="Delete" alt="Delete">
                        </button>
                        @csrf
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        <div class="phonenumbers-section__content__users">
            <h2>Users</h2>
            <div class="users">
                @foreach ($users as $user)
                <div class="user">
                    <span>{{ $user->name}}</span>
                    <button class="share" name="share" value="{{ $user->id }}" type="submit">
                        <img src="{{ asset('/images/share.svg') }}" title="Share" alt="Share">
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- if user shared phone can accept or reject -->
    <div class="phonenumbers-section__content__shared">
    </div>
</div>
@endsection
