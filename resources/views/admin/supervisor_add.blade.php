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

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 1.5rem;
        /* Add a subtle border around the entire pagination block if desired */
        border: 1px solid #dee2e6; /* Light gray border */
        border-radius: 0.25rem; /* Slightly rounded corners for the whole block */
        overflow: hidden; /* Ensures child borders don't spill */
    }

    .pagination .page-item {
        margin: 0; /* Remove individual item margins to make them stick together */
    }

    .pagination .page-link {
        padding: 8px 14px;
        border: none; /* Remove individual link borders as the parent will have one */
        background-color: #fff;
        color: #007bff; /* Blue text for inactive links */
        font-weight: 500;
        min-width: 42px;
        text-align: center;
        border-radius: 0; /* Square edges */
        transition: all 0.2s ease-in-out;
        /* Add a right border to separate links, except the last one */
        border-right: 1px solid #dee2e6;
    }

    .pagination .page-item:last-child .page-link {
        border-right: none; /* No border on the last item */
    }

    .pagination .page-link:hover {
        background-color: #e9ecef; /* Lighter hover background */
        color: #007bff;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff; /* Blue background for active link */
        color: #fff; /* White text for active link */
        border-color: #007bff; /* Blue border for active link */
        font-weight: bold;
    }

    .pagination .page-link:focus {
        box-shadow: none;
    }
</style>
@endsection

@section('content')
<div class="app-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Supervisor Roles</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body">
            <ul class="nav nav-tabs" id="entryTabs" role="tablist">
                @foreach(['rough' => 'Rough Super', 'finish' => 'Finish Super', 'engineer' => 'Engineer', 'manager' => 'Project Manager'] as $id => $label)
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if(request('active_tab', session('active_tab', 'rough')) == $id) active @endif"
                        id="{{ $id }}-tab"
                        href="?active_tab={{ $id }}"
                        role="tab">
                        {{ $label }}
                    </a>
                </li>
                @endforeach
            </ul>

            <div class="tab-content pt-4" id="entryTabsContent">
                @php
                    $tables = [
                        'rough' => ['title' => 'RoughSuper', 'items' => $roughSuper],
                        'finish' => ['title' => 'FinishSuper', 'items' => $finishSuper],
                        'engineer' => ['title' => 'Engineer', 'items' => $engineer],
                        'manager' => ['title' => 'ProjectActManager', 'items' => $pActManager],
                    ];
                    $activeTab = request('active_tab', session('active_tab', 'rough'));
                @endphp

                @foreach($tables as $id => $config)
                <div class="tab-pane fade @if($activeTab == $id) show active @endif" id="{{ $id }}" role="tabpanel" aria-labelledby="{{ $id }}-tab">
                    <h5 class="mb-3">{{ $config['title'] }}</h5>

                    <form action="{{ route('supervisor.store', $config['title']) }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="active_tab" value="{{ $id }}">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>

                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($config['items'] as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <button type="button"
                                        class="btn btn-sm btn-warning edit-inline"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}"
                                        data-model="{{ $config['title'] }}"
                                        data-tab="{{ $id }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('supervisor.delete', ['model' => $config['title'], 'id' => $item->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="active_tab" value="{{ $id }}">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                  <div class="mt-3">
    <div class="d-flex justify-content-between align-items-center">
        {{-- Displaying result count --}}
        <div class="pagination-info">
            Showing {{ $config['items']->firstItem() }} to {{ $config['items']->lastItem() }} of {{ $config['items']->total() }} results
        </div>

        {{-- Pagination links --}}
        <ul class="pagination mb-0">
            {{-- Previous Button --}}
            @if ($config['items']->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&laquo; Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $config['items']->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
                </li>
            @endif

            {{-- Next Button --}}
            @if ($config['items']->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $config['items']->nextPageUrl() }}" rel="next">Next &raquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">Next &raquo;</span>
                </li>
            @endif
        </ul>
    </div>
</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.edit-inline').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const model = this.dataset.model;
                const tab = this.dataset.tab;

                Swal.fire({
                    title: 'Edit Name',
                    html: `<input id="swal-input" class="swal2-input" value="${name}" placeholder="Enter name">` +
                          `<input type='hidden' id='swal-tab' value='${tab}'>`,
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    preConfirm: () => {
                        const newName = document.getElementById('swal-input').value;
                        if (!newName.trim()) {
                            Swal.showValidationMessage('Name is required');
                            return false;
                        }

                        return fetch(`/supervisors/update/${model}/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-HTTP-Method-Override': 'PUT'
                            },
                            body: JSON.stringify({ name: newName })
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Update failed');
                            return response.json();
                        })
                        .catch(err => {
                            Swal.showValidationMessage(err.message);
                        });
                    }
                }).then(result => {
                    if (result.isConfirmed) {
                        const tabValue = document.getElementById('swal-tab').value;
                        const url = new URL(window.location.href);
                        url.searchParams.set('active_tab', tabValue);
                        window.location.href = url.toString();
                    }
                });
            });
        });
    });
</script>
@endsection