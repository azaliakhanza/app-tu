@extends('layouts.template')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    <h2>Data Staff Tu</h2><br>
    <a href="{{ route('staff.create') }}" class="btn btn-primary">Tambah</a><br><br>

    <div class="col-md-6">
        <form action="{{ route('staff.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control">
                <button type="submit" class="btn btn-primary">Cari Data</button>
            </div>
        </form><br>

    </div>
    <table class="table table-striped table-bordered table-hovered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>

            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($staffs  as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['role'] }}</td>


                    <td class="d-flex">
                        <a href="{{ route('staff.edit', $item['id']) }}" class="btn btn-success">Edit</a>
                        <button type="button" class="btn mx-2 btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                            Hapus
                          </button>
                    </td>
                </tr>

                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian!</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p class="font-xl">
                            Apakah anda yakin untuk menghapus data foo?
                          </p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                          <form action="{{ route('staff.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn mx-2 btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Ya
                              </button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
    <div class="table-responsive col-lg-9">
      @if ($staffs->count())
      {{$staffs->links()}}
      @endif
  </div>
    <!-- Bootstrap Delete Confirmation Modal -->
<script>
    // JavaScript to handle the delete button click event
    $(document).ready(function () {
        $(".delete-button").click(function () {
            var id = $(this).data('id');

        });
    });
</script>
@endsection
