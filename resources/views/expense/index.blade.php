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
                <th>Edit</th>
                <th>View Bill</th>
            </tr>
            @foreach($expenses as $expense)
            <tr>
                <td>  {{ $expense->item_name  }}  </td>
                <td>  {{ $expense->cost }}  </td>
                <td>
                    <div class="btn-group">
                        <div class="drop-items-icon">
                            <i class="bi bi-wrench-adjustable"></i>
                            <a href="{{ route('expenses.edit', [$month, $category, $expense]) }} ">Edit Expense</a>
                        </div>     
                    </div>
                </td>
                <td>
                    <a  href="{{asset('storage/'.$expense->bill_path)}}" target="_blank">view</a>
                </td>
            </tr>
            @endforeach
        </table>
        @else
            <h1 style="text-align: center;">No Expense Exist</h1>      
        @endif
    </div>
</div>
@endsection
