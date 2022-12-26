@extends('layout.main')
@section('content')
<div class="allcontent">
    @if (session('success'))
        <p class="succesmessage">  {{ session('success') }}  </p>
    @endif
    <table class="table">
        <tr class="table-heading">
            <th>Month</th>
            <th>Total Expenses</th>
            <th>Comparision</th>
        </tr>
        @foreach ($months as $month)
        <tr>
            <td><a href=" {{ route('categories.month', $month)}} ">{{ $month->name }}</a></td>
            <td>{{ $month->expenses->sum('cost')}}</td>
                
                <td>{{ $month->total_expenses}}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection