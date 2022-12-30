@extends('layout.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard </a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>
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
            <td><a href=" {{ route('categories.month.expenses', [$month, $category])}} ">{{ $category->name }}</a></td>
                <td>  {{ $category->created_at  }}  </td>
                <td>
                    <div class="btn-group">
                        <div class="drop-items-icon">
                            <i class="bi bi-wrench-adjustable"></i>
                            <a href="{{ route('categories.edit', [$month, $category]) }} ">Edit Category</a>
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
    {{  $categories->links() }} 
</div>
@endsection
