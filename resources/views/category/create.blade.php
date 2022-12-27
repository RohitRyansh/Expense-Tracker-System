@extends('layout.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Category</li>
        </ol>
    </nav>
    <div class="create">
        @if (session('success'))
            <p class="succesmessage"> {{ session('success') }} </p>
        @endif
        <form action=" {{ route ('categories.store') }} " method="post" class="CourseCreate">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Category Name" required>
                <span class="errorMessage">
                    @error('name')
                     {{ $message }}      
                    @enderror
                </span>
            </div>

            <div class="saveButtons">
                <button type="submit" value="create" name="create" class="btn btn-secondary">Create Category</button>
                <button type="submit" value="create_another" name="create" class="btn btn-secondary">Create Category & Create Another</button>        
                <a href=" {{  route('dashboard')  }} " class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection