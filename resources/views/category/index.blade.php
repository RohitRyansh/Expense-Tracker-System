@extends('layout.main')
@section('content')
<div class="allcontent">
    <div class="nav">
        <div>
            <h2>Categories</h2>
        </div>
    </div>
        @if (session('success'))
            <p class="succesmessage">  {{  session('success')  }}  </p>
        @endif
        @if ($categories->count()>0)
        <table class="table">
            <tr class="table-heading">
                <th>Name</th>
                <th>Created date</th>
                <th>Edit</th>
                <th>Total Expenses</th>
            </tr>
            @foreach($categories as $category)
            <tr>
            <td><a class="dropdown-item" href=" {{ route('categories.month.expenses', $category)}} ">{{ $category->name }}</a></td>
                <td>  {{ $category->created_at  }}  </td>
                <td>
                    <div class="btn-group">
                        <div class="drop-items-icon">
                            <i class="bi bi-wrench-adjustable"></i>
                            <a href="{{ route('categories.edit', $category) }} ">Edit Category</a>
                        </div>     
                    </div>
                </td>
                <td>{{ $category->expenses->sum('cost')}}</td>
            </tr>
            @endforeach
        </table>
        @else
        <h1 style="text-align: center;">No Category Exist</h1>      
        @endif
    </div>
</div>
@endsection