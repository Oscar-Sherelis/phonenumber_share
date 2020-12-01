@extends('layouts.welcome')
@section('phonenumbers')
<div class="phonenumbers-section">
    <div class="phonenumbers-section__content">
        <div class="phonenumbers-section__content__phones">
            <h2>Phonenumbers</h2>
            @error('add')
            <p class="error">{{$message}}</p>
            @enderror
            <form class="add-phone-form" action="/phonenumbers/add" method="POST">
                <input type="number" name="add" placeholder="Add phonenumber" required>
                <button class="add" type="submit">Add new</button>
                @csrf
            </form>
            @if(count($phonenumbers) !== 0)
            <div class="phones">
                @if (\Session::has('success'))
                <span class="success-message">{!! \Session::get('success') !!}</span>
                @endif
                @error('delete')
                <span class="error">{{$message}}</span>
                @enderror
                <table>
                    <thead>
                        <tr>
                            <th>Phonenumber</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        <tr>
                    </thead>
                    <tbody>
                        @foreach ($phonenumbers as $phonenumber)
                        <tr class="phones-from-db">
                            <td>
                                {{ $phonenumber->phonenumber }}
                            </td>
                            <td>
                                <form action="/phonenumbers/edit" method="GET">
                                    <button class="edit" name="edit" value="{{ $phonenumber->id }}">
                                        <img src="{{ asset('/images/edit.svg') }}" title="Edit" alt="Edit">
                                    </button>
                                    @csrf
                                </form>
                            </td>
                            <td>
                                <form action="phonenumbers/delete" method="POST">
                                    <button name="delete" value="{{ $phonenumber->id }}" type="submit">
                                        <img class="delete-image" src="{{ asset('/images/del.svg') }}" title="Delete"
                                            alt="Delete">
                                    </button>
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
        <div class="phonenumbers-section__content__users">
            <h2>Share</h2>
            <div class="users">
                <form action="phonenumbers/share" method="POST">
                    @if (count($phonenumbers) !== 0)
                    <select name="phonenumber_list" class="phonenumber_list">
                        @foreach($phonenumbers as $phonenumber)
                        <option value="{{$phonenumber->id}}">
                            {{$phonenumber->phonenumber}}
                        </option>
                        @endforeach
                    </select>
                    @else
                    <span class="zero-item-found">*Cannot share, because no phonenumbers found</span>
                    @endif
                    @foreach ($users as $user)
                    <label class="user">{{ $user->name }}
                        <button class="share" name="shared_user" value="{{ $user->id }}" type="submit">
                            <img src="{{ asset('/images/share.svg') }}" title="Share" alt="Share">
                        </button>
                    </label>
                    @csrf
                    @endforeach
                </form>
            </div>
        </div>
        <div class="phonenumbers-section__content__shares">
            @if (count($shared) !== 0)
            <h2>Shared from Users</h2>
            <div class="phones shared-phones">
                <table>
                    <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Phonenumber</th>
                            <th>Add</th>
                            <th>Reject</th>
                        <tr>
                    </thead>
                    <tbody>
                        @foreach ($shared as $sharedPhonenumber)
                        <tr>
                            <td>{{$sharedPhonenumber->name}}</td>
                            <td>{{$sharedPhonenumber->phonenumber}}</td>
                            <td>
                                <form action="phonenumbers/share_add" method="POST">
                                    <button class="sharing-button" name="shared_number_id"
                                        value="{{ $sharedPhonenumber->id }}" type="submit">
                                        <img src="{{ asset('/images/add_shared.svg') }}" title="Share" alt="Share">
                                    </button>
                                    @csrf
                                </form>
                            </td>
                            <td>
                                <form action="phonenumbers/share_reject" method="POST">
                                    <button class="sharing-button" name="shared_number_id"
                                        value="{{ $sharedPhonenumber->id }}" type="submit">
                                        <img src="{{ asset('/images/del.svg') }}" title="Share" alt="Share">
                                    </button>
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
            </div>
            @else
            <span class="zero-item-found">*No one currently shared phonenumber</span>
            @endif
        </div>
    </div>
</div>
@endsection