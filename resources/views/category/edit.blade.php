@extends('layout.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
        </ol>
    </nav>
    <div class="create">
        <form action="{{ route ('categories.update', $category) }}" method="post" class="createForm">
            @csrf

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Category Name"  value="{{ $category->name }}" required>
                <span class="errorMessage">
                    @error('name')
                     {{ $message }}      
                    @enderror
                </span>
            </div>

            <div class="saveButtons">
                <button type="submit" value="Update" name="create" class="btn btn-secondary">Edit Category</button>
                <a href=" {{  route('dashboard')  }} " class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection