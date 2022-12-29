@extends('layout.main')
@section('content')
<div class="allcontent">
    @if (session('success'))
        <p class="succesmessage">  {{ session('success') }}  </p>
    @endif
        @php
            $j=0;
            $comparisions = [];
            
            for($i= 1; $i <= $months->count(); $i++) {

                if($i == 12) {

                    if($months[$j]->expenses->sum('cost') == 0) {
                        $comparisions[] += 0;
                    }
                    else {
                        $comparisions[] += 100;
                    }
                    break;
                }

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
            <td><a href=" {{ route('categories.month', $month)}}">{{ $month->name }}</a></td>
            <td>{{ $month->expenses->sum('cost') }}</td> 
        </tr>
        @endforeach

    </table>
    <table class="table2">
        <tr class="table-heading2">
            <th>Comparision</th>
        </tr>
        @foreach ($comparisions as $comparision)
        <tr class="table-heading2">
            @if ($comparision>0)   
                <td class="green">{{ number_format($comparision,2) .'%'}}</td> 
            @else
                <td class="red">{{ number_format($comparision,2) .'%'}}</td> 
            @endif
        </tr>
        @endforeach
    </table>
</div>
@endsection