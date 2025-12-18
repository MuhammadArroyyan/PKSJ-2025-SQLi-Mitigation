@extends('layouts.app')

@section('title', 'Edit Pertanyaan')

@section('extra_styles')
    <style>
        .pilihan-container {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }
        
        .pilihan-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }
        
        .pilihan-item input {
            flex: 1;
        }
        
        .pilihan-item button {
            background: #e74c3c;
            padding: 8px 12px;
        }
        
        .add-pilihan-btn {
            background: #27ae60;
            padding: 8px 12px;
        }
    </style>
@endsection

@section('sidebar')
    <a href="{{ route('kaprodi.dashboard') }}">Dashboard</a>
    <a href="{{ route('kaprodi.periode.index') }}">Periode Kuisioner</a>
    <a href="{{ route('kaprodi.pertanyaan.index') }}" class="active">Pertanyaan</a>
    <a href="{{ route('kaprodi.summary.index') }}">Summary</a>
    <a href="{{ route('kaprodi.jawaban.index') }}">Jawaban Mahasiswa</a>
@endsection

@section('content')
    <div class="page-header">
        <h1>Edit Pertanyaan</h1>
    </div>
    
    <div class="card">
        <form action="{{ route('kaprodi.pertanyaan.update', $pertanyaan->id_pertanyaan) }}" method="POST" id="pertanyaanForm">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="pertanyaan">Pertanyaan</label>
                <textarea id="pertanyaan" name="pertanyaan" rows="4" required>{{ old('pertanyaan', $pertanyaan->pertanyaan) }}</textarea>
                @error('pertanyaan')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Pilihan Jawaban</label>
                <div class="pilihan-container" id="pilihanContainer">
                    @forelse($pilihan as $p)
                        <div class="pilihan-item">
                            <input type="text" name="pilihan[]" value="{{ $p->deskripsi_pilihan }}" placeholder="Pilihan" required>
                            <button type="button" class="remove-pilihan">Hapus</button>
                        </div>
                    @empty
                        <div class="pilihan-item">
                            <input type="text" name="pilihan[]" placeholder="Pilihan 1" required>
                            <button type="button" class="remove-pilihan">Hapus</button>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="add-pilihan-btn" id="addPilihanBtn">+ Tambah Pilihan</button>
                @error('pilihan')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('kaprodi.pertanyaan.index') }}" class="btn">Batal</a>
        </form>
    </div>
    
    <script>
        let pilihanCount = document.querySelectorAll('.pilihan-item').length;
        
        document.getElementById('addPilihanBtn').addEventListener('click', function() {
            pilihanCount++;
            const container = document.getElementById('pilihanContainer');
            const div = document.createElement('div');
            div.className = 'pilihan-item';
            div.innerHTML = `
                <input type="text" name="pilihan[]" placeholder="Pilihan ${pilihanCount}" required>
                <button type="button" class="remove-pilihan">Hapus</button>
            `;
            container.appendChild(div);
            attachRemoveListeners();
        });
        
        function attachRemoveListeners() {
            document.querySelectorAll('.remove-pilihan').forEach(btn => {
                btn.onclick = function(e) {
                    e.preventDefault();
                    const items = document.querySelectorAll('.pilihan-item');
                    if(items.length > 2) {
                        this.parentElement.remove();
                    } else {
                        alert('Minimal harus ada 2 pilihan');
                    }
                };
            });
        }
        
        attachRemoveListeners();
    </script>
@endsection
