<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kartu Anggota Custom - {{ $anggota->no_kartu }}</title>
    <style>
        @page {
            size: {{ ($layout && isset($layout->field_positions['page_size'])) ? $layout->field_positions['page_size'] : '85mm 54mm' }};
            margin: 0;
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: {{ ($layout && isset($layout->field_positions['font_family'])) ? $layout->field_positions['font_family'] : 'Arial, sans-serif' }};
        }
        
        .kartu-container {
            position: relative;
            width: 100%;
            height: 100vh;
            @if($layout && $layout->file_path)
            background-image: url('{{ storage_path('app/public/' . $layout->file_path) }}');
            background-size: cover;
            background-position: center;
            @endif
        }
        
        @if($layout && $layout->field_positions && isset($layout->field_positions['fields']))
            @foreach($layout->field_positions['fields'] as $field => $position)
                .field-{{ $field }} {
                    position: absolute;
                    left: {{ $position['x'] ?? 0 }}mm;
                    top: {{ $position['y'] ?? 0 }}mm;
                    font-size: {{ $position['font_size'] ?? 8 }}pt;
                    color: {{ $position['color'] ?? '#000' }};
                    @if(isset($position['font_weight']))
                        font-weight: {{ $position['font_weight'] }};
                    @endif
                }
            @endforeach
        @endif
    </style>
</head>
<body>
    <div class="kartu-container">
        @if($layout && $layout->field_positions)
            <div class="field-no_kartu">{{ $anggota->no_kartu }}</div>
            <div class="field-nama">{{ $anggota->nama_lengkap }}</div>
            <div class="field-nik">{{ $anggota->nik_formatted }}</div>
            <div class="field-tanggal_lahir">{{ $anggota->tanggal_lahir->format('d/m/Y') }}</div>
            <div class="field-alamat">{{ $anggota->domisili_alamat_detail }}</div>
            @if($qrCode)
            <div class="field-qrcode">
                <img src="{{ storage_path('app/public/' . $qrCode) }}" style="width: 20mm;">
            </div>
            @endif
        @endif
    </div>
</body>
</html>