@extends('components.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">

                    <h2>Daftar buku</h2>
                </div>
                <pre>
                    <pre>
                    </pre>
                </pre>
                <div class align="flex-right">
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create">
                        Masukan Buku Baru
                    </a>
                </div>
                <div class align="right">
                    <div class="form" method="get" action="{{ route('search') }}">
                        <div class="form-group w-100 mb-3">
                            {{-- <label for="search" class="d-block mr-2">Pencarian</label> --}}
                            <input type="text" name="search" class="form-control w-15 d-inline" id="judul" placeholder="Cari Disini">
                            <button type="submit" class="btn btn-primary mb-1">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="dropdown w-auto" class align="right">
                    <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Export
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('bukus.export-excel') }}">Excel</a></li>
                        <li><a class="dropdown-item" href="{{ route('bukus.export-pdf') }}">PDF</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
        <table class="table table-bordered,sortable">
            <tr style="color:black" class align="center">
                <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
                <th>No</th>
                <th>ID Buku</th>
                <th>Judul</th>
                <th>Nama Pengarang</th>
                <th>Nama Penerbit</th>
                <th>Kategori</th>
                <th>Tahun Dirilis</th>
                <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
                <th width="240px">Action</th>
            </tr>
            @foreach ($bukus as $buku)
                <tr>
                    <td>{{ ++$i }}</td>
                    {{-- <td>{{ $buku->IUD }}<div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T') !!}</div></td> --}}
                    <td>{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T') !!}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->pengarang }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->kategori }}</td>
                    <td>{{ $buku->tahun }}</td>
                    <td>
                        <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST">
                            {{-- <a class="btn btn-info" href="{{ route('bukus.show', $buku->id) }}"><i class="fa-solid fa-eye"></i></a> --}}
                            <a class="btn btn-primary" href="{{ route('bukus.edit', $buku->id) }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <!-- <button type="button"  data-toggle="modal"
                                                    data-target="#exampleModalCenter">
                                                </button>  -->
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Yakin mau menghapus {{ $buku->judul }}?')"><i
                                    class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {!! $bukus->links() !!}

        <div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class align="center">
                                    <h2>Tambahkan Buku</h2>
                                </div>
                                <!-- <div class="pull-right">
                                            <a class="btn btn-primary" href="{{ route('bukus.index') }}"> Back</a>
                                        </div> -->
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Ada input yang salah!<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('bukus.store') }}" method="POST">
                            @csrf
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Judul:</strong>
                                    <input type="text" name="judul"required class="form-control" placeholder="Judul">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nama Pengarang:</strong>
                                    <input type="text" name="pengarang" required class="form-control"
                                        placeholder="Nama Pengarang">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nama Penerbit:</strong>
                                    <input type="text" name="penerbit" required class="form-control"
                                        placeholder="Nama Penerbit">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Kategori Buku:</strong>
                                    <select class="form-control" id="kategori" required name="kategori">
                                        <option value="Pilih kategori" selected disabled>Pilih kategori</option>
                                        <option value="Romantis">Romantis</option>
                                        <option value="Horor">Horor</option>
                                        <option value="Misteri">Misteri</option>
                                        <option value="Komedi">Komedi</option>
                                        <option value="Inspiratif">Inspiratif</option>
                                        <option value="Sejarah">Sejarah</option>
                                        <option value="Petualangan">Petualangan</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Tahun Dirilis:</strong>
                                    <input type="date" name="tahun" required class="form-control"
                                        placeholder="Tahun Dirilis">
                                </div>
                            </div>
                            <!-- <select class="form-control" id="tahun" name="tahun">
                                                                <option value="Pilih Tahun" selected disabled>Pilih Tahun</option>
                                                                <option value="2000">2000</option>
                                                                <option value="2001">2001</option>
                                                                <option value="2002">2002</option>
                                                                <option value="2003">2003</option>
                                                                <option value="2004">2004</option>
                                                                <option value="2005">2005</option>
                                                                <option value="2006">2006</option>
                                                                <option value="2007">2007</option>
                                                                <option value="2008">2008</option>
                                                                <option value="2008">2008</option>
                                                                <option value="2009">2009</option>
                                                                <option value="2010">2010</option>
                                                                <option value="2011">2011</option>
                                                                <option value="2012">2012</option>

                                                            </select> -->
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
