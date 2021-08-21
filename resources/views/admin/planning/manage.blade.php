@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="h3 mb-4 text-gray-800"><b>{{ __('Manage Event') }} - {{ $event->name }}</b></h1>

    <!-- Main Content goes here -->
    <div id="task" class="d-flex flex-row flex-nowrap overflow-auto">
        <div class="col-md-3" style="min-width: 300px">
            <div class="card5">
                <div class="card-header">
                    <h5 class="mb-1">{{ $event->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="list-group mb-2">
                        <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Waktu Mulai</h5>
                            </div>
                            <p class="mb-1">{{ $event->time }}</p>
                        </div>
                        @if ($event->end)
                            <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Waktu Selesai</h5>
                                </div>
                                <p class="mb-1">{{ $event->end }}</p>
                            </div>
                        @endif
                        @if ($event->category)
                            <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Kategori</h5>
                                </div>
                                <p class="mb-1">{{ $event->category }}</p>
                            </div>
                        @endif
                        <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Contact Person</h5>
                            </div>
                            <p class="mb-1">{{ $event->contact_person }}</p>
                        </div>
                        <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Lokasi</h5>
                            </div>
                            <p class="mb-1">{{ $event->location }}</p>
                        </div>
                        <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Deskripsi</h5>
                            </div>
                            <p class="mb-1">{{ $event->description }}</p>
                        </div>
                        <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Penyelenggara</h5>
                            </div>
                            <p class="mb-1">{{ $event->organizer }}</p>
                        </div>
                        @if ($event->price)
                            <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Harga Tiket</h5>
                                </div>
                                <p class="mb-1">{{ $event->price }}</p>
                            </div>
                        @endif
                        @if ($event->quota)
                            <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Kuota</h5>
                                </div>
                                <p class="mb-1">{{ $event->quota }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @foreach ($event->tahaps as $tahap)
            <div class="col-md-3" style="min-width: 300px">
                <div class="card5">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="list-header-target mb-1">{{ $tahap->nama }}</h5>
                            </div>
                            <div class="col-sm-1 p-0">
                                <button type="button" onclick="editTahap('{{ $tahap->nama }}','{{ $tahap->id }}')"
                                    class="btn btn-link btn-sm float-end">
                                    <i class="fa fa-edit fa-fw"></i>
                                </button>
                            </div>
                            <div class="col-sm-1 p-0">
                                <form action="{{ route('manageevent.destroy', $tahap->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Apakah Anda Yakin ?')"
                                        class="btn btn-link btn-sm float-end">
                                        <i class="fas fa-trash fa-fw"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="list-group mb-2">
                            <form action="{{ route('manageevent.storedetail') }}" method="POST">
                                @csrf
                                <input type="hidden" name="tahap_id" value="{{ $tahap->id }}">
                                <div class="input-group mb-2">
                                    <input type="text" name="nama" class="form-control" placeholder="Tambah Task">
                                    <button type="submit" class="btn btn-dark btn-sm px-4"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </form>
                            @foreach ($tahap->details as $detail)
                                <div class="list-group mb-2">
                                    <div class="list-group-item list-group-item-action flex-column align-items-start p-2">
                                        <div class="d-flex w-100 justify-content-between">
                                            <div onclick="detailModal('{{ $detail->nama }}','{{ $detail->deskripsi }}', '{{ $detail->id }}')"
                                                class="col pl-1" style="cursor: pointer;">
                                                <h5>{{ $detail->nama }}</h5>
                                            </div>
                                            <span class="col-sm-1 p-0">
                                                <button type="button"
                                                    onclick="updateDetail('{{ $detail->nama }}','{{ $detail->deskripsi }}', '{{ $detail->id }}')"
                                                    class="btn btn-link btn-sm float-end">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                </button>
                                            </span>
                                            <div class="col-sm-1 p-0">
                                                <form action="{{ route('manageevent.destroydetail', $detail->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="return confirm('Apakah Anda Yakin ?')"
                                                        class="btn btn-link btn-sm float-end">
                                                        <i class="fas fa-trash fa-fw"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        @endforeach
        <div class="col-md-3" style="min-width: 300px">

            <form action="{{ route('manageevent.store') }}" method="POST">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">

                <div class="card5">
                    <div class="card-header">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Event">
                    </div>
                    <div class="card-footer text-muted">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form id="formDetail" method="POST" action="">
                @method('PUT')
                @csrf()
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="member">
                            <div class="input-group">
                                <input type="text" name="nama" class="form-control" placeholder="nama" id="modalNama">
                            </div>
                        </div>

                        <div class="deskripsi">
                            <h5>Deskripsi</h5>
                            <div class="form-group">
                                <textarea name="deskripsi" class="form-control" id="modalDeskripsi" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deskripsi">
                        <h5>Deskripsi</h5>
                        <div class="form-group">
                            <textarea readonly class="form-control" id="detailDeskripsi" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="member">
                        <form id="formAddMember" method="POST" action="">
                            @csrf()
                            @method('POST')
                            <input type="hidden" name="detail_id" id="detail_id" value="">
                            <h5>Team Member</h5>
                            <div class="input-group mb-2">
                                <input type="text" name="email" class="form-control" placeholder="Tambah anggota baru">
                                <button type="submit" class="btn btn-dark btn-sm px-4"><i class="fas fa-plus"></i></button>
                            </div>
                        </form>
                        <div id="memberList" class="list-group member mb-2">

                        </div>
                    </div>
                    <div class="checklist">
                        <h5>Progress</h5>
                        <div id="progress" class="progress mb-2">
                        </div>
                        <form id="formChecklist" method="POST" action="">
                            @csrf()
                            @method('POST')
                            <input type="hidden" name="detail_id" id="checklist_detail_id" value="">
                            <h5>List Task</h5>
                            <div class="input-group mb-2">
                                <input type="text" name="nama" class="form-control" placeholder="Tambah list task baru">
                                <button type="submit" class="btn btn-dark btn-sm px-4"><i class="fas fa-plus"></i></button>
                            </div>
                        </form>
                        <div id="checklist" class="list-group member mb-2">

                        </div>
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

    <script>
        var SITEURL = "{{ url('/admin/manageevent') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function editTahap(nama, id) {
            var namabaru = prompt("Masukan nama baru", nama);
            $.ajax({
                url: SITEURL + "/" + id,
                type: "PUT",
                data: {
                    nama: namabaru
                },
                success: function(response) {
                    alert("Event Updated Successfully");
                    location.reload(true)
                }
            })
        }

        function updateDetail(nama, deskrispsi, id) {
            $('#modalTitle').html(nama)
            $('#modalNama').val(nama)
            $('#modalDeskripsi').val(deskrispsi)
            $('#formDetail').attr('action', `${SITEURL}/detail/${id}`);
            $('#updateModal').modal()
        }

        function detailModal(nama, deskripsi, id) {
            $.ajax({
                url: SITEURL + "/detail/" + id,
                type: "GET",

                success: function(response) {
                    $('#formAddMember').attr('action', `${SITEURL}/detail/addmember`);
                    $('#formChecklist').attr('action', `${SITEURL}/detail/checklist`);
                    $('#detail_id').val(id)
                    $('#checklist_detail_id').val(id)
                    $('#memberList').html('')
                    $('#checklist').html('')
                    const members = response.data.members
                    const checklists = response.checklist
                    for (let i = 0; i < members.length; i++) {
                        $('#memberList').append(`<div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1">${members[i].name} ${members[i].last_name}</p>
                                <div class="col-sm-1 p-0">
                                    <form action="${SITEURL}/detail/${id}/${members[i].id}/deletemember" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Apakah Anda Yakin ?')"
                                            class="btn btn-link btn-sm float-end">
                                            <i class="fas fa-trash fa-fw"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>`)
                    }
                    for (let i = 0; i < checklists.length; i++) {
                        let icon = checklists[i].completed ? "fa-times" : "fa-check"
                        let style = checklists[i].completed ? "text-decoration:line-through" : ""
                        $('#checklist').append(`<div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <form action="${SITEURL}/detail/checklist/${checklists[i].id}/togglechecklist" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" onclick="return confirm('Apakah Anda Yakin ?')"
                                    class="btn btn-link btn-sm float-end pl-0 pr-0 mt-1">
                                        <i class="fas ${icon} fa-fw"></i>
                                    </button>
                                </form>
                                <div class="col-sm-10 p-1 mt-1">
                                    <p class="mb-1" style="${style}">${checklists[i].nama}</p>
                                </div>
                                <div class="col-sm-1 p-1">
                                    <form action="${SITEURL}/detail/checklist/${checklists[i].id}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Apakah Anda Yakin ?')"
                                            class="btn btn-link btn-sm float-end">
                                            <i class="fas fa-trash fa-fw"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>`)
                    }
                    const persentase = parseFloat(response.persentase).toFixed(2)

                    $('#progress').html(`
                    <div class="progress-bar" role="progressbar" style="width: ${persentase}%;" aria-valuenow="${persentase}"
                    aria-valuemin="0" aria-valuemax="100">${persentase}%</div>
                    `)
                    $('#detailTitle').html(nama)
                    $('#detailDeskripsi').val(deskripsi)
                    $('#detailModal').modal()
                }
            })


        }
    </script>
@endpush
