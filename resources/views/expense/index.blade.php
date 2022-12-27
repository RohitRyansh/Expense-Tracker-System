@extends('layout.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categories.month', $month)}}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Expenses</li>
        </ol>
    </nav>
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
