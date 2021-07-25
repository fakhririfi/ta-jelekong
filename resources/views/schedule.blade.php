
@extends('layouts.calendaradmin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Calendar') }}</h1>

    <!-- Main Content goes here -->

    <div id='calendar'></div>
    <div id="myModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="time">Waktu</label>
                        <input type="text" class="form-control datepicker" id="modalTime" disabled placeholder="Waktu"/>
                    </div>
                    <div id="groupCategory" class="form-group">
                        <label for="category">Kategori</label>
                        <input type="text" class="form-control" id="modalCategory" disabled placeholder="Kategori"/>
                    </div>
                    <div class="form-group">
                        <label for="contact_person">Contact Person</label>
                        <input type="text" class="form-control" id="modalContact_person" disabled placeholder="Contact Person"/>
                    </div>
                    <div class="form-group">
                        <label for="location">Lokasi</label>
                        <input type="text" class="form-control" id="modalLocation" disabled placeholder="Lokasi"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="modalDescription" disabled placeholder="Deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="organizer">Penyelenggara</label>
                        <input type="text" class="form-control" id="modalOrganizer" disabled placeholder="Penyelenggara"/>
                    </div>
                    <div id="groupPrice" class="form-group">
                        <label for="price">Harga Tiket</label>
                        <input type="text" class="form-control" id="modalPrice" disabled placeholder="Harga Tiket"/>
                    </div>
                    <div id="groupKuota" class="form-group">
                        <label for="quota">Kuota</label>
                        <input type="text" class="form-control" id="modalQuota" disabled placeholder="Kuota"/>
                    </div>
                    </div>
                    <div id="modalAction" class="modal-footer">
                    <form id="formDelete" action="#" method="post">
                @csrf
                @method('delete')
                <button type="submit" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-primary">
                    Delete
                </button>
            </form>
            <a  id="btnUpdate" href="#" class="btn btn-secondary">
                Edit
            </a>

                    </div>
                </div>
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


