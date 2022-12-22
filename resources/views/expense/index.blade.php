@extends('layout.main')
@section('content')
<div class="allcontent">
    <div class="nav">
        <div>
            <h2>Expenses</h2>
        </div>
    </div>
        @if (session('success'))
            <p class="succesmessage">  {{  session('success')  }}  </p>
        @endif
        @if ($expenses->count()>0)
        <table class="table">
            <tr class="table-heading">
                <th>Item Name</th>
                <th>Cost</th>
                <th></th>
            </tr>
            @foreach($expenses as $expense)
            <tr>
                <td>  {{ $expense->item_name  }}  </td>
                <td>  {{ $expense->cost }}  </td>
                <div class="course-image">
                    <img src="{{asset('storage/'.$expense->images->bill)}}" alt="not found">
                </div>
            </tr>
            @endforeach
        </table>
        @else
            <h1 style="text-align: center;">No Expense Exist</h1>      
        @endif
    </div>
</div>
@endsection
