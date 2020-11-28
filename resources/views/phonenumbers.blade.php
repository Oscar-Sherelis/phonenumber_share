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
                            <!-- <td>
                                <form action="phonenumbers/share" method="POST">
                                    <input type="checkbox" name="checked_to_share[]" value="{{ $phonenumber->id }}">
                                    @csrf
                                </form>
                            </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="phonenumbers-section__content__users">
            <h2>Share</h2>
            <div class="users">
                <form action="phonenumbers/share" method="POST">
                    <select name="phonenumber_list" class="phonenumber_list">
                        @foreach($phonenumbers as $phonenumber)
                        <option value="{{$phonenumber->id}}">
                            {{$phonenumber->phonenumber}}
                        </option>
                        @endforeach
                    </select>
                    @foreach ($users as $user)
                    <label class="user">{{ $user->name }}
                        <button class="share" name="shared_user" value="{{ $user->id }}" type="submit">
                            <img src="{{ asset('/images/share.svg') }}" title="Share" alt="Share">
                        </button>
                    </label>
                    @endforeach
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection