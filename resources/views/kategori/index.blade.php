@extends('layouts.backend.app',['activePage' => 'KategoriTable', 'titlePage' => 'Daftar Kategori'])

@section('content')

<div class="content">
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="card-header card-header-primary">
                <h4 class="card-title mt-0"> Data Kategori </h4>
                <p class="card-category"> Here is a subtitle for this table</p>
                <div class="pt-2">
                    <a href="/kategori/create">
                        <button type="submit" class="btn btn-succes">tambah</button>
                    </a>
                </div>
                @if (session('status'))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="">
                            <th> Nomer </th>
                            <th> ID </th>
                            <th> Nama Kategori </th>
                            <th> Dibuat Pada </th>
                            <th> Action </th>
                        </thead>
                        <tbody>
                            @foreach($kategoris as $nomer => $kategori )
                            @php
                                $stats = [''];
                                if ($kategori->status == 'Y') {
                                $stats = 'Nonaktifkan';
                                } else {
                                $stats = 'Aktifkan';
                                }
                            @endphp
                            <tr>
                                <td> {{ $nomer + 1 }}</td>
                                <td> {{ $kategori->id }}</td>
                                <td> {{ $kategori->nama_kategori }}</td>
                                <td> {{ $kategori->created_at }}</td>
                                <td class="row">
                                    <a rel="tooltip" class="btn btn-success btn-link" href="/kategori/{{ $kategori->id }}/edit" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </a>                             
                                    <form action="/kategori/{{$kategori->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-success btn-link">
                                            <i class="material-icons">delete</i>
                                            <div class="ripple-container"></div>
                                        </button>
                                    </form>
                                    <form action="/kategori/status/{{ $kategori->id }}" method="post">
                                        @csrf
                                        <button class="btn btn-success btn-link">
                                            {{$stats}}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
