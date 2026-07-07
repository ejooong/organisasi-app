<div class="d-flex gap-1 justify-content-center">
    <a href="{{ route('admin.anggota.show', $anggota->id) }}" 
       class="btn btn-sm btn-light text-info rounded-circle shadow-sm" 
       style="width: 32px; height: 32px; padding: 5px;"
       title="Detail" 
       data-bs-toggle="tooltip">
        <i class="fas fa-eye"></i>
    </a>

    @role('super_admin')
    <a href="{{ route('admin.anggota.edit', $anggota->id) }}" 
       class="btn btn-sm btn-light text-warning rounded-circle shadow-sm" 
       style="width: 32px; height: 32px; padding: 5px;"
       title="Edit" 
       data-bs-toggle="tooltip">
        <i class="fas fa-edit"></i>
    </a>
    @endrole

    <button onclick="cetakKartu({{ $anggota->id }})" 
            class="btn btn-sm btn-light text-success rounded-circle shadow-sm" 
            style="width: 32px; height: 32px; padding: 5px;"
            title="Cetak Kartu" 
            data-bs-toggle="tooltip">
        <i class="fas fa-id-card"></i>
    </button>
    
    <button onclick="previewKartu({{ $anggota->id }})" 
            class="btn btn-sm btn-light text-primary rounded-circle shadow-sm" 
            style="width: 32px; height: 32px; padding: 5px;"
            title="Preview Kartu" 
            data-bs-toggle="tooltip">
        <i class="fas fa-search"></i>
    </button>

    @role('super_admin')
    <button onclick="hapusAnggota({{ $anggota->id }})" 
            class="btn btn-sm btn-light text-danger rounded-circle shadow-sm" 
            style="width: 32px; height: 32px; padding: 5px;"
            title="Hapus" 
            data-bs-toggle="tooltip">
        <i class="fas fa-trash"></i>
    </button>
    @endrole
</div>