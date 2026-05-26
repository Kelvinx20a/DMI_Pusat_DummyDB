@extends('admin.layout.layout_admin')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('admin/css/berita.css') }}">
    <style>
        .form-page { max-width: 960px; margin: 0 auto; padding: 32px 0 48px; }
        .page-title { font-size: 32px; font-weight: 800; color: #111; margin-bottom: 8px; letter-spacing: -0.8px; }
        .page-subtitle { font-size: 14px; color: #888; margin-bottom: 40px; font-weight: 500; }

        .form-card { background: white; border-radius: 24px; border: none; margin-bottom: 24px; box-shadow: 0 2px 20px rgba(0,0,0,0.04); padding: 36px; transition: box-shadow 0.3s; }
        .form-card:hover { box-shadow: 0 8px 32px rgba(0,0,0,0.07); }
        .form-card-title { font-size: 13px; font-weight: 700; color: #2E7D32; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 1px; }

        .field { margin-bottom: 24px; }
        .field:last-child { margin-bottom: 0; }
        .field-label { display: block; font-size: 14px; font-weight: 600; color: #333; margin-bottom: 10px; }
        .field-label .req { color: #ef4444; margin-left: 2px; }
        .field-input { width: 100%; padding: 16px 20px; border: none; border-radius: 14px; font-size: 15px; font-family: 'Poppins', sans-serif; transition: all 0.3s; background: #f7f7f7; color: #111; }
        .field-input:focus { outline: none; background: #fff; box-shadow: 0 0 0 2px #2E7D32, 0 8px 24px rgba(46,125,50,0.06); }
        .field-input::placeholder { color: #bbb; }

        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .trix-wrap { border-radius: 14px; overflow: hidden; background: #f7f7f7; transition: box-shadow 0.3s; }
        .trix-wrap:focus-within { box-shadow: 0 0 0 2px #2E7D32, 0 8px 24px rgba(46,125,50,0.06); background: #fff; }
        trix-toolbar { background: #fff; border-bottom: 1px solid #f0f0f0; padding: 10px 14px; }
        trix-editor { min-height: 320px; background: transparent; padding: 20px; font-size: 15px; border: none !important; }

        .tags-list { display: flex; flex-direction: column; gap: 12px; }
        .tag-row { display: flex; gap: 10px; align-items: center; }
        .tag-row input { flex: 1; }
        .tag-btn { width: 44px; height: 44px; border: none; border-radius: 12px; font-size: 20px; font-weight: 700; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; }
        .tag-btn-add { background: #2E7D32; color: white; }
        .tag-btn-add:hover { background: #1b5e20; transform: scale(1.08); }
        .tag-btn-del { background: #fef2f2; color: #ef4444; }
        .tag-btn-del:hover { background: #fee2e2; transform: scale(1.08); }

        .drop-area { border: 2px dashed #e0e0e0; border-radius: 18px; padding: 52px 32px; text-align: center; cursor: pointer; transition: all 0.3s; background: #fafafa; }
        .drop-area:hover { border-color: #2E7D32; background: #f5fbf6; transform: translateY(-3px); box-shadow: 0 12px 32px rgba(46,125,50,0.06); }
        .drop-area.drag-over { border-color: #2E7D32; background: #edf7ee; }
        .drop-text { font-size: 15px; color: #555; margin: 0; }
        .drop-text a { color: #2E7D32; font-weight: 700; text-decoration: none; border-bottom: 2px solid #2E7D32; }
        .drop-hint { font-size: 12px; color: #aaa; margin-top: 12px; }

        .img-preview { margin-top: 20px; text-align: center; }
        .img-preview img { width: 100%; max-width: 360px; height: 220px; object-fit: cover; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .img-preview-name { font-size: 12px; color: #999; margin-top: 10px; }
        .img-preview-btns { display: flex; gap: 10px; margin-top: 14px; justify-content: center; }
        .img-preview-btns button { padding: 10px 24px; border: none; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .img-btn-change { background: #f0f7ff; color: #1565c0; }
        .img-btn-change:hover { background: #e0efff; }

        .form-footer { display: flex; gap: 14px; justify-content: flex-end; padding-top: 16px; }
        .f-btn { padding: 15px 40px; border: none; border-radius: 14px; font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; }
        .f-btn-primary { background: #2E7D32; color: white; box-shadow: 0 8px 24px rgba(46,125,50,0.18); }
        .f-btn-primary:hover { background: #236b27; transform: translateY(-3px); box-shadow: 0 12px 32px rgba(46,125,50,0.24); }
        .f-btn-ghost { background: transparent; color: #666; border: 2px solid #eee; }
        .f-btn-ghost:hover { background: #f5f5f5; border-color: #ddd; }

        @media (max-width: 768px) {
            .form-page { padding: 16px 0 32px; }
            .page-title { font-size: 24px; }
            .page-subtitle { margin-bottom: 28px; }
            .form-card { padding: 24px 20px; border-radius: 18px; }
            .field-row { grid-template-columns: 1fr; gap: 0; }
            .drop-area { padding: 32px 18px; }
            .form-footer { flex-direction: column; }
            .f-btn { width: 100%; padding: 16px; }
        }
    </style>
@endpush

@section('content')
<div class="form-page">
    <h1 class="page-title">Edit Berita</h1>
    <p class="page-subtitle">Perbarui informasi berita di bawah ini</p>

    <form id="formBerita" action="{{ route('posts.update', $post->ID) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- BASIC INFO -->
        <div class="form-card">
            <div class="form-card-title">Informasi Dasar</div>
            <div class="field">
                <label class="field-label">Judul Berita <span class="req">*</span></label>
                <input type="text" name="judul" class="field-input" required autocomplete="off" placeholder="Tulis judul berita yang menarik..." value="{{ old('judul', $post->post_title) }}">
            </div>
            <div class="field-row">
                <div class="field">
                    <label class="field-label">Kategori <span class="req">*</span></label>
                    <input type="text" name="tagline" class="field-input" autocomplete="off" placeholder="Contoh: Teknologi, Bisnis..." value="{{ old('tagline', $tagline ?? '') }}">
                </div>
                <div class="field">
                    <label class="field-label">Penulis <span class="req">*</span></label>
                    <input type="text" name="penulis" class="field-input" required autocomplete="off" placeholder="Nama penulis..." value="{{ old('penulis', $namaPenulis ?? '') }}">
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="form-card">
            <div class="form-card-title">Konten Berita</div>
            <div class="field">
                <label class="field-label">Isi Berita <span class="req">*</span></label>
                <div class="trix-wrap">
                    <input type="hidden" name="isi_berita" id="isi_berita" value="{{ old('isi_berita', $post->post_content) }}">
                    <trix-editor input="isi_berita" class="custom-trix"></trix-editor>
                </div>
            </div>
        </div>

        <!-- KEYWORDS -->
        <div class="form-card">
            <div class="form-card-title">Kata Kunci</div>
            <div class="tags-list" id="tagsContainer">
                @if($tags->count() > 0)
                    @foreach($tags as $tag)
                        <div class="tag-row">
                            <input type="text" name="tags[]" class="field-input" autocomplete="off" value="{{ $tag->tag_name }}">
                            <button type="button" class="tag-btn tag-btn-del btn-del-tag">−</button>
                        </div>
                    @endforeach
                @endif
                <div class="tag-row">
                    <input type="text" name="tags[]" class="field-input" autocomplete="off" placeholder="Tambah kata kunci baru...">
                    <button type="button" class="tag-btn tag-btn-add btn-add-tag">+</button>
                </div>
            </div>
        </div>

        <!-- IMAGE -->
        <div class="form-card">
            <div class="form-card-title">Foto & Caption</div>
            <div class="field">
                <label class="field-label">Gambar Utama <span class="req">*</span></label>
                <input type="file" name="gambar" id="inputGambar" accept=".jpg,.jpeg,.png,.webp,.avif,image/jpeg,image/png,image/webp,image/avif" style="display:none;">

                @if($post->getImageUrl())
                    <div class="drop-area" id="uploadBox" role="button" tabindex="0">
                        <div id="previewBox" class="img-preview" style="margin-top:0;">
                            <img id="previewImg" src="{{ $post->getImageUrl() }}" alt="Current">
                            <p id="previewName" class="img-preview-name">Gambar saat ini — klik untuk ganti</p>
                        </div>
                    </div>
                @else
                    <div class="drop-area" id="uploadBox" role="button" tabindex="0">
                        <p class="drop-text">Drag & drop gambar atau <a>pilih file</a></p>
                        <p class="drop-hint">JPG, PNG, WEBP, AVIF — Maksimal 5MB</p>
                    </div>
                    <div id="previewBox" class="img-preview" style="display:none;">
                        <img id="previewImg" alt="Preview">
                        <p id="previewName" class="img-preview-name"></p>
                    </div>
                @endif

                <div id="progressBox" style="display:none; margin-top:14px;">
                    <div style="background:#f0f0f0; border-radius:99px; height:6px; overflow:hidden;">
                        <div id="progressBar" style="height:100%; width:0%; background:#2E7D32; border-radius:99px; transition:width 0.3s;"></div>
                    </div>
                    <p id="progressText" style="font-size:12px; color:#888; margin:8px 0 0;">Mengupload...</p>
                </div>
            </div>
            <div class="field">
                <label class="field-label">Caption Foto <span class="req">*</span></label>
                <input type="text" name="caption" class="field-input" autocomplete="off" placeholder="Deskripsi singkat gambar..." value="{{ old('caption', $post->post_excerpt) }}">
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="form-footer">
            <a href="{{ route('posts.index') }}" class="f-btn f-btn-ghost">Batal</a>
            <button type="submit" class="f-btn f-btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
@if ($errors->any())
<script>
    const errorMessages = @json($errors->all());
    const errorModal = document.createElement('div');
    errorModal.innerHTML = `
        <div id="errorOverlay" style="position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.4); z-index:9998; backdrop-filter:blur(4px);"></div>
        <div id="errorModal" style="position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:white; border-radius:24px; padding:36px; max-width:400px; width:90%; text-align:center; z-index:9999; box-shadow:0 24px 64px rgba(0,0,0,0.15);">
            <h5 style="font-weight:700; font-size:18px; margin-bottom:12px; color:#ef4444;">Terjadi Kesalahan</h5>
            <ul style="text-align:left; color:#555; font-size:14px; margin-bottom:24px; padding-left:20px; line-height:1.8;">
                ${errorMessages.map(msg => '<li>' + msg + '</li>').join('')}
            </ul>
            <button onclick="document.getElementById('errorOverlay').remove(); document.getElementById('errorModal').remove();" style="background:#2E7D32; color:white; border:none; padding:12px 48px; border-radius:12px; font-weight:700; cursor:pointer; font-size:14px;">OK</button>
        </div>
    `;
    document.body.appendChild(errorModal);
</script>
@endif

<script>
    document.addEventListener('trix-file-accept', function(e) {
        if (!/^image\/(jpeg|png|webp|avif)$/.test(e.file.type)) e.preventDefault();
    });

    document.addEventListener('trix-attachment-add', function(e) {
        const attachment = e.attachment;
        if (attachment.file) {
            const form = new FormData();
            form.append('file', attachment.file);
            form.append('_token', '{{ csrf_token() }}');
            fetch('{{ route("trix.upload") }}', { method: 'POST', body: form })
                .then(r => r.json())
                .then(data => attachment.setAttributes({ url: data.url, href: data.url }));
        }
    });

    (function guardTrixFocus() {
        let pointerTarget = null;
        let allowTrixFocusUntil = 0;
        document.addEventListener('pointerdown', function(e) {
            pointerTarget = e.target;
            if (e.target.closest('trix-editor, .trix-wrap, trix-toolbar, .attachment, figcaption, [data-trix-mutable]')) allowTrixFocusUntil = Date.now() + 800;
        }, true);
        function setupEditor(editor) {
            if (editor.dataset.focusGuardReady === '1') return;
            editor.dataset.focusGuardReady = '1';
            editor.scrollIntoView = function() {};
            editor.setAttribute('tabindex', '-1');
            editor.addEventListener('pointerdown', () => allowTrixFocusUntil = Date.now() + 800, true);
            editor.addEventListener('keydown', () => allowTrixFocusUntil = Date.now() + 800, true);
            editor.addEventListener('focus', function() {
                if (Date.now() < allowTrixFocusUntil || editor.contains(pointerTarget)) return;
                requestAnimationFrame(function() {
                    editor.blur();
                    const f = pointerTarget?.closest?.('input:not([type="hidden"]), textarea, select');
                    if (f) f.focus({ preventScroll: true });
                });
            });
        }
        document.addEventListener('trix-initialize', e => setupEditor(e.target));
        document.querySelectorAll('trix-editor').forEach(setupEditor);
        document.addEventListener('DOMContentLoaded', () => document.querySelectorAll('trix-editor').forEach(setupEditor));
    })();

    document.addEventListener('mousedown', function(e) {
        if (!e.target.closest('input, textarea, select, button, a, trix-editor, [contenteditable="true"], label')) document.activeElement?.blur();
    });

    const allowedImageTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];
    const allowedImageExtensions = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
    const maxImageSize = 5 * 1024 * 1024;

    function validateImage(file) {
        const ext = file.name.split('.').pop().toLowerCase();
        if (!allowedImageTypes.includes(file.type) || !allowedImageExtensions.includes(ext)) { alert('Format gambar harus JPG, JPEG, PNG, WEBP, atau AVIF.'); inputGambar.value = ''; return false; }
        if (file.size > maxImageSize) { alert('Ukuran gambar maksimal 5MB.'); inputGambar.value = ''; return false; }
        return true;
    }

    const tagsContainer = document.getElementById('tagsContainer');
    const uploadBox = document.getElementById('uploadBox');
    const inputGambar = document.getElementById('inputGambar');
    const previewBox = document.getElementById('previewBox');
    const previewImg = document.getElementById('previewImg');
    const previewName = document.getElementById('previewName');

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-add-tag')) {
            const row = document.createElement('div');
            row.className = 'tag-row';
            row.innerHTML = '<input type="text" name="tags[]" class="field-input" autocomplete="off" placeholder="Masukkan kata kunci..."><button type="button" class="tag-btn tag-btn-del btn-del-tag">−</button>';
            tagsContainer.insertBefore(row, e.target.closest('.tag-row'));
        }
        if (e.target.classList.contains('btn-del-tag')) e.target.closest('.tag-row').remove();
    });

    if (uploadBox) {
        uploadBox.addEventListener('dragover', e => { e.preventDefault(); uploadBox.classList.add('drag-over'); });
        uploadBox.addEventListener('dragleave', () => uploadBox.classList.remove('drag-over'));
        uploadBox.addEventListener('drop', e => { e.preventDefault(); uploadBox.classList.remove('drag-over'); const f = e.dataTransfer.files[0]; if (f && validateImage(f)) { inputGambar.files = e.dataTransfer.files; showPreview(f); } });
        uploadBox.addEventListener('click', () => inputGambar.click());
        uploadBox.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); inputGambar.click(); } });
    }

    inputGambar.addEventListener('change', e => { const f = e.target.files[0]; if (f && validateImage(f)) showPreview(f); });

    function showPreview(file) {
        const progressBox = document.getElementById('progressBox');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        uploadBox.style.display = 'none';
        progressBox.style.display = 'block';
        progressBar.style.width = '0%';
        progressText.textContent = 'Mengupload... 0%';
        const reader = new FileReader();
        reader.onprogress = e => { if (e.lengthComputable) { const p = Math.round((e.loaded/e.total)*100); progressBar.style.width = p+'%'; progressText.textContent = 'Mengupload... '+p+'%'; } };
        reader.onload = e => { progressBar.style.width = '100%'; progressText.textContent = 'Selesai!'; setTimeout(() => { progressBox.style.display = 'none'; previewImg.src = e.target.result; previewName.textContent = file.name + ' — klik untuk ganti'; previewBox.style.display = 'block'; uploadBox.style.display = 'block'; }, 400); };
        reader.readAsDataURL(file);
    }

    document.getElementById('formBerita').addEventListener('submit', function() { document.querySelectorAll('button[type="submit"]').forEach(b => b.disabled = true); });
</script>
@endpush
