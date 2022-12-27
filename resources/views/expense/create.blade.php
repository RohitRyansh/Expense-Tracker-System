@extends('layout.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }} ">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Expense</li>
        </ol>
    </nav>
    <div class="create">
        @if (session('success'))
            <p class="succesmessage"> {{ session('success') }} </p>
        @endif
        <form action=" {{ route ('expenses.store') }} " method="post" class="CourseCreate" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Item Name</label>
                <input type="text" name="item_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Item Name" required>
                <span class="errorMessage">
                    @error('item_name')
                     {{ $message }}      
                    @enderror
                </span>
            </div>

            <label for="category" class="form-label">Which Category Should The Expense Be In?</label> 
            <select class="form-select" name="category_id" aria-label="Default select example">
                @foreach($categories as $category)
                    <option value=" {{ $category['id'] }} "> {{ $category['name'] }} </option>
                @endforeach
            </select>

            <label for="date" class="form-label">Date of Expense</label> 
            <input type="date" name="date_of_expense" id="">
            <span class="errorMessage">
                @error('date_of_expense')
                 {{ $message }}      
                @enderror
            </span>

            <label for="cost" class="form-label">Cost of Expense</label> 
            <input type="number" name="cost" id="">
            <span class="errorMessage">
                @error('cost')
                 {{ $message }}      
                @enderror
            </span>

            <label for="bill" class="form-label">Bill should be a Image or Pdf</label> 
            <input type="file" name="bill_path" required>
            <span class="errorMessage">
                @error('bill_path')
                 {{ $message }}      
                @enderror
            </span>

            <div class="saveButtons">
                <button type="submit" value="create" name="create" class="btn btn-secondary">Add Expense</button>
                <a href=" {{  route('dashboard')  }} " class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection