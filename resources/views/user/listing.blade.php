@extends('layout.main')
@section('content')
<div class="allcontent">
    <div class="nav">
        <div>
            <h2>Expenses</h2>
        </div>
    </div>
    <div>
        <div class="dropdown">  
            <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
                Sort By
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href=" {{ route('expenses.listing')}}?this_week=this_week">This Week</a></li>
                <li><a class="dropdown-item" href="{{ route('expenses.listing')}}?last_week=last_week">Last Week </a></li>
                <li><a class="dropdown-item" href="{{ route('expenses.listing')}}?this_month=this_month">This Month </a></li>
                <li><a class="dropdown-item" href="{{ route('expenses.listing')}}?last_month=last_month">Last Month </a></li>
                <div class="date_to_from">
                    <form action="{{ route('expenses.listingByDate')}}" method="post">
                        @csrf
                        <label for="date" class="form-label">To</label> 
                        <input type="date" name="to" id="" required>
                        <span class="errorMessage">
                            @error('to')
                             {{ $message }}      
                            @enderror
                        </span>
                        <label for="date" class="form-label">From</label> 
                        <input type="date" name="from" id="" required>
                        <span class="errorMessage">
                            @error('from')
                             {{ $message }}      
                            @enderror
                        </span>
                        <input type="submit" value="apply" name="apply">
                    </form>
                </div>
            </ul>
        </div>
    </div> 
    @if ($expenses->count()>0)
    <table class="table">
            <tr class="table-heading">
                <th>Item Name</th>
                <th>Cost</th>
                <th>Date of Expense</th>
            </tr>
            @foreach($expenses as $expense)
            <tr>
                <td>  {{ $expense->item_name  }}  </td>
                <td>  {{ $expense->cost }}  </td>
                <td> {{ $expense->date_of_expense}}</td>
            </tr>
            @endforeach
        </table>
        @else
        <h1 style="text-align: center;">No Expense Exist</h1>      
        @endif
    </div>
</div>
@endsection
