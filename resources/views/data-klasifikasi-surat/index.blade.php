{{-- untuk mengimpor template --}}
@extends('layouts.template')

{{-- untuk mengisi yield --}}
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    <h1>Data Klarifikasi Surat</h1>
    <br>
    <a href="{{ route('data-klasifikasi-surat.create') }}" class="btn btn-success mb-4">Tambah</a>
    <table class="table table-striped table-bordered table-hovered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Surat</th>
                <th scope="col">Klasifikasi Surat</th>
                <th scope="col">Surat Tertaut</th>

            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($letter  as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['letter_code'] }}</td>
                    <td>{{ $item['name_type'] }}</td>


                    <td class="d-flex">
                        <a href="{{ route('data-klasifikasi-surat.edit', $item['id']) }}" class="btn btn-success">Edit</a>
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
                          <form action="{{ route('data-klasifikasi-surat.delete', $item->id) }}" method="POST">
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
