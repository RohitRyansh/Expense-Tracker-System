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
        @foreach ($months as $month)
        <tr>
            <td><a href=" {{ route('categories.month', $month)}}">{{ $month->name }}</a></td>
            <td>{{ $month->total_expenses }}</td> 
            @if ($month->comparisions > 0)   
                <td class="green">{{ number_format($month->comparisions,2) .'%'}}</td> 
            @elseif ($month->comparisions == 0)
                <td>{{number_format($month->comparisions,2) .'%'}}</td> 
            @else
                <td class="red">{{number_format($month->comparisions,2) .'%'}}</td> 
            @endif
        </tr>
        @endforeach

    </table>
</div>
@endsection