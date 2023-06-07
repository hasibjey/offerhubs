@extends('layouts.app')

@section('content')
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <div class="text-center">
            <a href="route('logout')" class="btn btn-sm btn-outline-danger"
                onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ _('Logout') }}
            </a>
        </div>
    </form>
@endsection
