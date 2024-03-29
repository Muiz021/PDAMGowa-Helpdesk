@if (auth()->user()->roles == 'user')
    {{-- create --}}
    <div class="modal fade" id="create-pengaduan" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="{{ route('pengaduan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Membuat Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jenis_pengaduan" class="form-control-label">Jenis Pengaduan</label>
                            <select name="jenis_pengaduan" id="SelectLm" class="form-control-sm form-control">
                                <option value="">Please select</option>
                                @if (!$airTidakMengalir)
                                    <option value="1">Air Tidak Mengalir</option>
                                @endif
                                @if (!$airKeruh)
                                    <option value="2">Air Keruh</option>
                                @endif
                                @if (!$keberatanBayar)
                                    <option value="3">Keberatan Bayar</option>
                                @endif
                                @if (!$pembenahanSambungan)
                                    <option value="4">Pembenahan Sambungan</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bukti_pengaduan" class="form-control-label">Bukti Pengaduan</label>
                            <input type="file" name="bukti_pengaduan" class="form-control-sm form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end create --}}

    {{-- edit --}}
    @foreach ($pengaduans as $item)
        <div class="modal fade" id="update-pengaduan-{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form
                        action="{{ Auth::user()->roles == 'admin' ? route('pengaduan.admin.update', $item->id) : route('pengaduan.update', $item->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Membuat Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="jenis_pengaduan" class="form-control-label">Jenis Pengaduan</label>
                                <select name="jenis_pengaduan" id="SelectLm" class="form-control-sm form-control">
                                    <option value="">Please select</option>
                                    <option value="1"
                                        {{ $item->jenis_pengaduan == 'air_tidak_mengalir' ? 'selected' : '' }}>Air Tidak
                                        Mengalir</option>
                                    <option value="2"
                                        {{ $item->jenis_pengaduan == 'air_keruh' ? 'selected' : '' }}>Air
                                        Keruh</option>
                                    <option value="3"
                                        {{ $item->jenis_pengaduan == 'keberatan_bayar' ? 'selected' : '' }}>Keberatan
                                        Bayar
                                    </option>
                                    <option value="4"
                                        {{ $item->jenis_pengaduan == 'pembenahan_sambungan' ? 'selected' : '' }}>
                                        Pembenahan
                                        Sambungan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bukti_pengaduan" class="form-control-label">Bukti Pengaduan</label>
                                <input type="file" name="bukti_pengaduan" class="form-control-sm form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            @if ($item->status_pengaduan == 'proses' || $item->status_pengaduan == 'selesai')
                                <button disabled class="btn btn-primary">Edit</button>
                            @else
                                <button type="submit" class="btn btn-primary">Edit</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- edit --}}
@else
    {{-- export pdf --}}
    <div class="modal fade" id="export-pdf" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="{{route('export-pdf')}}" method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Export PDF</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="start_date" class="form-control-label">Awal tanggal:</label>
                            <input type="date" name="start_date" class="form-control-sm form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="form-control-label">Akhir tanggal:</label>
                            <input type="date" name="end_date" class="form-control-sm form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="status_pengaduan" class="form-control-label">Status</label>
                            <select name="status_pengaduan" class="form-control-sm form-control" required>
                                <option value="ditolak">Ditolak</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end export pdf --}}
@endif
