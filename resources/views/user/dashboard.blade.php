@extends('layout.main')
@section('content')
<div class="allcontent">
    @if (session('success'))
        <p class="succesmessage">  {{ session('success') }}  </p>
    @endif
        @php
            $j=0;
            $comparisions = [];
            for($i= 1; $i <= $months->count()-1; $i++) {
                
                $current_month =  $months[$j];
                $previous_month =  $months[$i];
                $j++;
                
                if($current_month->expenses->sum('cost') == 0) {
                    
                    $comparisions[] = $current_month->expenses->sum('cost');
                    continue;
                }
                
                $comparisions[] = ($current_month->expenses->sum('cost')
                    - $previous_month->expenses->sum('cost'))
                    / $current_month->expenses->sum('cost') * 100;    
            }
        @endphp
    <table class="table">
        <tr class="table-heading">
            <th>Month</th>
            <th>Total Expenses</th>
        @foreach ($months as $month)
        <tr>
            <td><a href=" {{ route('categories.month', $month)}} ">{{ $month->name }}</a></td>
            <td>{{ $month->expenses->sum('cost') }}</td> 
        </tr>
        @endforeach

    </table>
    <table class="table2">
        <tr class="table-heading2">
            <th>Comparision</th>
        </tr>
        @php
            $comparisions[] += $months[11]->expenses->sum('cost');
        @endphp
        @foreach ($comparisions as $comparision)
        <tr class="table-heading2">
            <td>{{ $comparision .'%'}}</td> 
        </tr>
        @endforeach
    </table>
</div>
@endsection