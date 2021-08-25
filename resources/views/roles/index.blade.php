@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('User Management') }}</h1>

    <!-- Main Content goes here -->

    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body p-0 table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <?php $no = 1; ?>
                    @foreach ($user as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->name }} {{ $data->last_name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                <form id="roleChange{{ $data->id }}" action="{{ route('edit.roles', $data->id) }}"
                                    method="post">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" class="form-control form-control-sm w-50"
                                        onchange="roleChange(this)" id="user-{{ $data->id }}">
                                        <option value="admin" @if ('admin' === $data->role)selected @endif>
                                            Admin
                                        </option>
                                        <option value="member" @if ('member' === $data->role)selected @endif>
                                            Member
                                        </option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush

@push('js')
    <script>
        function roleChange(element) {
            let id = element.id;
            id = id.replace('user-', '');
            document.getElementById('roleChange' + id).submit();
        }
    </script>
@endpush
