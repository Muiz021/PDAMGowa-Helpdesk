{{-- edit --}}
<div class="modal fade" id="profil-{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="{{ route('update-profil',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Edit Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama" class="form-control-label">Nama</label>
                        <input type="text" name="nama" class="form-control-sm form-control" value="{{Auth::user()->nama}}">
                    </div>
                    <div class="form-group">
                        <label for="nama" class="form-control-label">Username</label>
                        <input type="text" name="username" class="form-control-sm form-control" value="{{Auth::user()->username}}">
                    </div>
                    <div class="form-group">
                        <label for="nama" class="form-control-label">Password</label>
                        <input type="text" name="password" class="form-control-sm form-control">
                    </div>
                    <div class="form-group">
                        <label for="no_whatsapp" class="form-control-label">NIK</label>
                        <input type="text" name="nik" class="form-control-sm form-control" value="{{Auth::user()->nik}}">
                    </div>
                    <div class="form-group">
                        <label for="no_whatsapp" class="form-control-label">No. Whatsapp</label>
                        <input type="text" name="no_whatsapp" class="form-control-sm form-control" value="{{Auth::user()->no_whatsapp}}">
                    </div>
                    <div class="form-group">
                        <label for="no_whatsapp" class="form-control-label">No. Sambungan</label>
                        <input type="text" name="nosamb" class="form-control-sm form-control">
                    </div>
                    <div class="form-group">
                        <label for="no_whatsapp" class="form-control-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control-sm form-control" cols="20" rows="10">{{Auth::user()->alamat}}</textarea>
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
{{-- end edit --}}
