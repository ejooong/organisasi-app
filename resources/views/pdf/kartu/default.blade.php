<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kartu Anggota - {{ $anggota->no_kartu }}</title>
    <style>
        @page {
            size: 85mm 54mm; /* Ukuran kartu ID Card standar */
            margin: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .page-break {
            page-break-after: always;
        }
        
        .kartu {
            width: 85mm;
            height: 54mm;
            position: relative;
            overflow: hidden;
            @if(!isset($layout) || !$layout || $layout->tipe_file !== 'image')
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            @endif
            color: {{ ($layout && isset($layout->field_positions['color'])) ? $layout->field_positions['color'] : '#ffffff' }};
        }

        .bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        
        .element-custom {
            position: absolute;
            font-weight: bold;
        }

        /* Default fallback coordinates jika custom layout belum diatur/disimpan */
        .no-kartu {
            top: {{ ($layout && isset($layout->field_positions['no_kartu']['top'])) ? $layout->field_positions['no_kartu']['top'] : '5' }}mm;
            left: {{ ($layout && isset($layout->field_positions['no_kartu']['left'])) ? $layout->field_positions['no_kartu']['left'] : '50' }}mm;
            font-size: {{ ($layout && isset($layout->field_positions['no_kartu']['size'])) ? $layout->field_positions['no_kartu']['size'] : '10' }}pt;
            letter-spacing: 1px;
        }
        
        .nama {
            top: {{ ($layout && isset($layout->field_positions['nama']['top'])) ? $layout->field_positions['nama']['top'] : '25' }}mm;
            left: {{ ($layout && isset($layout->field_positions['nama']['left'])) ? $layout->field_positions['nama']['left'] : '5' }}mm;
            font-size: {{ ($layout && isset($layout->field_positions['nama']['size'])) ? $layout->field_positions['nama']['size'] : '14' }}pt;
            text-transform: uppercase;
        }
        
        .qr-code {
            top: {{ ($layout && isset($layout->field_positions['qr']['top'])) ? $layout->field_positions['qr']['top'] : '35' }}mm;
            left: {{ ($layout && isset($layout->field_positions['qr']['left'])) ? $layout->field_positions['qr']['left'] : '68' }}mm;
            width: {{ ($layout && isset($layout->field_positions['qr']['size'])) ? $layout->field_positions['qr']['size'] : '12' }}mm;
            height: {{ ($layout && isset($layout->field_positions['qr']['size'])) ? $layout->field_positions['qr']['size'] : '12' }}mm;
            position: absolute;
        }
        
        .qr-code img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <!-- Halaman Depan -->
    @if($layout && $layout->file_path_depan)
    <div class="kartu">
        <img src="{{ storage_path('app/public/' . $layout->file_path_depan) }}" class="bg-img" alt="Background Depan">
    </div>
    <div class="page-break"></div>
    @endif

    <!-- Halaman Belakang -->
    <div class="kartu">
        @if($layout && $layout->file_path)
            <img src="{{ storage_path('app/public/' . $layout->file_path) }}" class="bg-img" alt="Background Belakang">
        @endif
        
        <div class="element-custom no-kartu">{{ trim(chunk_split($anggota->no_kartu, 4, ' ')) }}</div>
        <div class="element-custom nama">{{ $anggota->nama_lengkap }}</div>
        
        @if($qrCode)
        <div class="qr-code">
            <img src="{{ storage_path('app/public/' . $qrCode) }}" alt="QR Code">
        </div>
        @endif
    </div>
</body>
</html>