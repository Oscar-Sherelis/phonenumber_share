@extends('layouts.welcome')
@section('edit_phone')
<div class="edit_phone">
    <form action="/phonenumbers/edited" method="POST">
    @foreach($phonenumber as $phone)
        <input type="number" name="new_number" value="{{ $phone->phonenumber }}" required>
        <button class="submit_edit" name="change" value="{{ $phone->id }}" type="submit">Change</button>
    @endforeach
    @csrf
    </form>
</div>
@endsection