@extends('layout.main')
@section('content')
<div class="allcontent">
    @if (session('success'))
        <p class="succesmessage">  {{  session('success')  }}  </p>
    @endif
    <ul class="dropdown-menu">
        @foreach ($months as $month)
            <li><a class="dropdown-item" href=" {{ route('categories.month', $month)}} ">{{ $month->name }}</a></li>
            <p>{{ $month->expenses->sum('cost')}}</p>
        @endforeach
    </ul>
@endsection