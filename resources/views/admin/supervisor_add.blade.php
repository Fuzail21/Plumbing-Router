@extends('layouts.app')

@section('layouts')
    @include('layouts.navigation')
    @include('layouts.sidenavbar')
@endsection

@section('style')
<style>
    .nav-tabs .nav-link.active {
        background-color: #021962;
        color: #fff;
        border-color: #021962 #021962 #fff;
    }
    .nav-tabs .nav-link {
        color: #021962;
    }
</style>
@endsection

@section('content')
<div class="app-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body">
            <!-- Tabs -->
            <ul class="nav nav-tabs" id="entryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="rough-tab" data-bs-toggle="tab" data-bs-target="#rough" type="button" role="tab">Rough Super</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="finish-tab" data-bs-toggle="tab" data-bs-target="#finish" type="button" role="tab">Finish Super</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="engineer-tab" data-bs-toggle="tab" data-bs-target="#engineer" type="button" role="tab">Engineer</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="manager-tab" data-bs-toggle="tab" data-bs-target="#manager" type="button" role="tab">Project Manager</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content pt-4" id="entryTabsContent">
                <div class="tab-pane fade show active" id="rough" role="tabpanel" aria-labelledby="rough-tab">
                    <h5 class="mb-3">Rough Super</h5>
                    <form action="{{ route('supervisor.store', 'RoughSuper') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name_rough" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name_rough" name="name" placeholder="Enter name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="finish" role="tabpanel" aria-labelledby="finish-tab">
                    <h5 class="mb-3">Finish Super</h5>
                    <form action="{{ route('supervisor.store', 'FinishSuper') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name_finish" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name_finish" name="name" placeholder="Enter name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="engineer" role="tabpanel" aria-labelledby="engineer-tab">
                    <h5 class="mb-3">Engineer</h5>
                    <form action="{{ route('supervisor.store', 'Engineer') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name_engineer" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name_engineer" name="name" placeholder="Enter name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="manager" role="tabpanel" aria-labelledby="manager-tab">
                    <h5 class="mb-3">Project Manager</h5>
                    <form action="{{ route('supervisor.store', 'ProjectActManager') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name_manager" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name_manager" name="name" placeholder="Enter name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
