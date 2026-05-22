@extends('admin.layout.layout_admin')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('admin/css/berita.css') }}">
    <style>
        .form-page { max-width: 900px; margin: 0 auto; }
        .form-section { background: white; border-radius: 20px; border: 1px solid #e6ece8; margin-bottom: 20px; }
        .form-section-header { background: #f7faf8; padding: 18px 24px; border-bottom: 1px solid #e6ece8; border-radius: 20px 20px 0 0; }
        .form-section-header h3 { font-size: 16px; font-weight: 700; color: #17231b; margin: 0; }
        .form-section-body { padding: 24px; }
        .form-group { margin-bottom: 20px; }
        .form-group:last-child { margin-bottom: 0; }
        .form-group label { display: block; font-size: 14px; font-weight: 700; color: #374151; margin-bottom: 8px; }
        .form-group label .required { color: #e53935; }
        .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid #e6ece8; border-radius: 12px; font-size: 14px; font-family: 'Poppins', sans-serif; transition: all 0.2s; }
        .form-control:focus { outline: none; border-color: #2E7D32; box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1); }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-full { grid-column: 1 / -1; }
        
        .trix-wrapper { border: 1.5px solid #e6ece8; border-radius: 12px; overflow: hidden; }
        trix-editor { min-height: 250px; background: #fff; }
        trix-toolbar { background: #f7faf8; border-bottom: 1px solid #e6ece8; padding: 8px 0; }
        
        .tags-container { display: flex; flex-direction: column; gap: 10px; }
        .tag-input { display: flex; gap: 8px; align-items: stretch; }
        .tag-input input { flex: 1; }
        .tag-input button { min-width: 44px; padding: 0; background: #2E7D32; color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.2s; }
        .tag-input button:hover { background: #1b5e20; }
        .tag-input .btn-delete { background: #d32f2f; }
        .tag-input .btn-delete:hover { background: #b71c1c; }
        
        .upload-box { border: 2px dashed #cbd8cf; border-radius: 16px; padding: 32px; text-align: center; cursor: pointer; transition: all 0.2s; background: #fafbfa; }
        .upload-box:hover { border-color: #2E7D32; background: #f0f7f1; }
        .upload-box.drag-over { border-color: #2E7D32; background: #f0f7f1; box-shadow: 0 10px 28px rgba(46, 125, 50, 0.08); }
        .upload-icon { font-size: 48px; margin-bottom: 12px; }
        .upload-text { font-size: 14px; color: #666; margin: 0; }
        .upload-hint { font-size: 12px; color: #8a968e; margin-top: 8px; }
        .upload-browse { color: #2E7D32; font-weight: 600; cursor: pointer; }
        
        .preview-box { position: relative; margin-top: 14px; text-align: center; }
        .preview-img { width: 100%; max-width: 300px; height: 200px; object-fit: cover; border-radius: 12px; border: 1px solid #e6ece8; }
        .preview-name { font-size: 13px; color: #667085; margin: 10px 0 0; word-break: break-word; }
        .preview-actions { display: flex; gap: 10px; margin-top: 12px; }
        .preview-actions button { padding: 8px 16px; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-change { background: #e3f2fd; color: #1565c0; }
        .btn-change:hover { background: #bbdefb; }
        
        .form-actions { display: flex; gap: 12px; justify-content: center; padding: 24px; }
        .btn { padding: 12px 32px; border: none; border-radius: 12px; font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background: linear-gradient(135deg, #f7b84b 0%, #efaa31 100%); color: white; box-shadow: 0 4px 12px rgba(247, 184, 75, 0.2); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(247, 184, 75, 0.3); }
        .btn-secondary { background: #e6ece8; color: #374151; }
        .btn-secondary:hover { background: #d8e5dc; }
        
        @media (max-width: 768px) {
            .form-row { grid-template-columns: 1fr; }
            .form-section-body { padding: 16px; }
            .upload-box { padding: 20px; }
            .form-actions { flex-direction: column; }
            .btn { width: 100%; justify-content: center; }
        }
    </style>
@endpush

@section('content')
<div class="form-page">
    <h2 class="judul-halaman">Edit Berita</h2>

    <form id="formBerita" action="{{ route('posts.update', $post->ID) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- BASIC INFO -->
        <div class="form-section">
            <div class="form-section-header">
                <h3>📝 Informasi Dasar</h3>
            </div>
            <div class="form-section-body">
                <div class="form-row">
                    <div class="form-group">
                        <label>Judul <span class="required">*</span></label>
                        <input type="text" name="judul" class="form-control" required autocomplete="off" placeholder="Masukkan judul berita..." value="{{ old('judul', $post->post_title) }}">
                    </div>
                    <div class="form-group">
                        <label>Kategori <span class="required">*</span></label>
                        <input type="text" name="tagline" class="form-control" autocomplete="off" placeholder="Contoh: Teknologi, Bisnis..." value="{{ old('tagline', $tagline ?? '') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Penulis <span class="required">*</span></label>
                    <input type="text" name="penulis" class="form-control" required autocomplete="off" placeholder="Nama penulis..." value="{{ old('penulis', $namaPenulis ?? '') }}">
                </div>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="form-section">
            <div class="form-section-header">
                <h3>📄 Deskripsi Lengkap</h3>
            </div>
            <div class="form-section-body">
                <div class="form-group form-full">
                    <label>Konten Berita <span class="required">*</span></label>
                    <div class="trix-wrapper">
                        <input type="hidden" name="isi_berita" id="isi_berita" value="{{ old('isi_berita', $post->post_content) }}">
                        <trix-editor input="isi_berita" class="custom-trix"></trix-editor>
                    </div>
                </div>
            </div>
        </div>

        <!-- KEYWORDS -->
        <div class="form-section">
            <div class="form-section-header">
                <h3>🏷️ Kata Kunci</h3>
            </div>
            <div class="form-section-body">
                <div class="tags-container" id="tagsContainer">
                    @if($tags->count() > 0)
                        @foreach($tags as $tag)
                            <div class="tag-input">
                                <input type="text" name="tags[]" class="form-control" autocomplete="off" value="{{ $tag->tag_name }}">
                                <button type="button" class="btn-delete">−</button>
                            </div>
                        @endforeach
                    @else
                        <div class="tag-input">
                            <input type="text" name="tags[]" class="form-control" autocomplete="off" placeholder="Masukkan kata kunci...">
                            <button type="button" class="btn-add-tag">+</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- IMAGE & CAPTION -->
        <div class="form-section">
            <div class="form-section-header">
                <h3>🖼️ Foto & Caption</h3>
            </div>
            <div class="form-section-body">
                <div class="form-group form-full">
                    <label>Gambar Utama <span class="required">*</span></label>
                    <input type="file" name="gambar" id="inputGambar" accept=".jpg,.jpeg,.png,.webp,.avif,image/jpeg,image/png,image/webp,image/avif" style="display:none;">
                    
                    @if($post->getImageUrl())
                        <div class="upload-box" id="dropZone" role="button" tabindex="0" style="position:relative; padding:20px;">
                            <div id="previewBox" class="preview-box" style="margin-top:0;">
                                <img id="previewImg" class="preview-img" src="{{ $post->getImageUrl() }}" alt="Current">
                                <p id="previewName" class="preview-name">Gambar saat ini</p>
                                <div class="preview-actions" style="justify-content:center;">
                                    <button type="button" class="btn-change" id="btnChangeImage">Ganti Gambar</button>
                                </div>
                                <p class="upload-hint">Atau drag & drop gambar baru ke area ini. Format JPG, JPEG, PNG, WEBP, AVIF. Maksimal 5MB.</p>
                            </div>
                        </div>
                        <div id="progressBox" style="display:none; margin-top:12px;">
                            <div style="background:#e6ece8; border-radius:8px; height:8px; overflow:hidden;">
                                <div id="progressBar" style="height:100%; width:0%; background:linear-gradient(90deg,#2E7D32,#4CAF50); border-radius:8px; transition:width 0.3s;"></div>
                            </div>
                            <p id="progressText" style="font-size:12px; color:#666; margin:6px 0 0;">Mengupload...</p>
                        </div>
                    @else
                        <div class="upload-box" id="dropZone" role="button" tabindex="0">
                            <div class="upload-icon">📤</div>
                            <p class="upload-text">Drag & drop atau <span class="upload-browse">pilih gambar</span></p>
                            <p class="upload-hint">Format JPG, JPEG, PNG, WEBP, AVIF. Maksimal 5MB.</p>
                        </div>
                        <div id="progressBox" style="display:none; margin-top:12px;">
                            <div style="background:#e6ece8; border-radius:8px; height:8px; overflow:hidden;">
                                <div id="progressBar" style="height:100%; width:0%; background:linear-gradient(90deg,#2E7D32,#4CAF50); border-radius:8px; transition:width 0.3s;"></div>
                            </div>
                            <p id="progressText" style="font-size:12px; color:#666; margin:6px 0 0;">Mengupload...</p>
                        </div>
                        <div id="previewBox" class="preview-box" style="display:none;">
                            <img id="previewImg" class="preview-img" alt="Preview">
                            <p id="previewName" class="preview-name">Gambar dipilih</p>
                            <div class="preview-actions" style="justify-content:center;">
                                <button type="button" class="btn-change" id="btnChangeImage">Ganti Gambar</button>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="form-group form-full">
                    <label>Caption Foto <span class="required">*</span></label>
                    <input type="text" name="caption" class="form-control" autocomplete="off" placeholder="Deskripsi singkat gambar..." value="{{ old('caption', $post->post_excerpt) }}">
                </div>
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="form-actions">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">← Batal</a>
            <button type="submit" class="btn btn-primary">✓ Simpan Perubahan</button>
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
        <div id="errorOverlay" style="position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9998;"></div>
        <div id="errorModal" style="position:fixed; top:50%; left:50%; transform:translate(-50%,-50%); background:white; border-radius:20px; padding:30px; max-width:400px; width:90%; text-align:center; z-index:9999; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
            <h5 style="font-weight:700; font-size:18px; margin-bottom:10px; color:#e53935;">⚠️ Oops!</h5>
            <ul style="text-align:left; color:#666; font-size:14px; margin-bottom:20px; padding-left:20px;">
                ${errorMessages.map(msg => `<li>${msg}</li>`).join('')}
            </ul>
            <button onclick="document.getElementById('errorOverlay').remove(); document.getElementById('errorModal').remove();" style="background:#f7b84b; color:white; border:none; padding:10px 40px; border-radius:12px; font-weight:600; cursor:pointer; font-size:14px;">OK</button>
        </div>
    `;
    document.body.appendChild(errorModal);
</script>
@endif

<script>
    document.addEventListener('trix-file-accept', e => e.preventDefault());

    (function guardTrixFocus() {
        let pointerTarget = null;

        document.addEventListener('pointerdown', function(e) {
            pointerTarget = e.target;
        }, true);

        function setupEditor(editor) {
            if (editor.dataset.focusGuardReady === '1') {
                return;
            }

            editor.dataset.focusGuardReady = '1';
            let directEditorInteraction = false;

            editor.scrollIntoView = function() {};

            editor.addEventListener('pointerdown', function() {
                directEditorInteraction = true;
                window.setTimeout(() => directEditorInteraction = false, 600);
            });

            editor.addEventListener('focus', function() {
                if (directEditorInteraction || editor.contains(pointerTarget)) {
                    return;
                }

                requestAnimationFrame(function() {
                    editor.blur();

                    if (pointerTarget?.matches?.('input:not([type="hidden"]), textarea, select')) {
                        pointerTarget.focus({ preventScroll: true });
                    }
                });
            });
        }

        document.addEventListener('trix-initialize', e => setupEditor(e.target));
        document.querySelectorAll('trix-editor').forEach(setupEditor);
        document.addEventListener('DOMContentLoaded', () => document.querySelectorAll('trix-editor').forEach(setupEditor));
    })();

    document.addEventListener('mousedown', function(e) {
        const focusable = 'input, textarea, select, button, a, trix-editor, [contenteditable="true"], label';
        if (!e.target.closest(focusable)) {
            document.activeElement?.blur();
        }
    });

    const allowedImageTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];
    const allowedImageExtensions = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
    const maxImageSize = 5 * 1024 * 1024;

    function validateImage(file) {
        const extension = file.name.split('.').pop().toLowerCase();
        if (!allowedImageTypes.includes(file.type) || !allowedImageExtensions.includes(extension)) {
            alert('Format gambar harus JPG, JPEG, PNG, WEBP, atau AVIF.');
            inputGambar.value = '';
            return false;
        }

        if (file.size > maxImageSize) {
            alert('Ukuran gambar maksimal 5MB.');
            inputGambar.value = '';
            return false;
        }

        return true;
    }

    // Tags management
    const tagsContainer = document.getElementById('tagsContainer');
    const dropZone = document.getElementById('dropZone');
    const inputGambar = document.getElementById('inputGambar');
    const previewBox = document.getElementById('previewBox');
    const previewImg = document.getElementById('previewImg');
    const previewName = document.getElementById('previewName');
    const btnChangeImage = document.getElementById('btnChangeImage');

    // Add/remove tags
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-add-tag')) {
            const newTag = document.createElement('div');
            newTag.className = 'tag-input';
            newTag.innerHTML = `
                <input type="text" name="tags[]" class="form-control" autocomplete="off" placeholder="Masukkan kata kunci...">
                <button type="button" class="btn-delete">−</button>
            `;
            tagsContainer.appendChild(newTag);
        }

        if (e.target.classList.contains('btn-delete')) {
            e.target.closest('.tag-input').remove();
        }
    });

    // Drag & drop on dropZone card
    dropZone.addEventListener('dragover', e => {
        e.preventDefault();
        dropZone.classList.add('drag-over');
    });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
        const file = e.dataTransfer.files[0];
        if (file && validateImage(file)) {
            inputGambar.files = e.dataTransfer.files;
            showPreview(file);
        }
    });

    dropZone.addEventListener('click', function(e) {
        if (!e.target.closest('button')) {
            inputGambar.click();
        }
    });
    dropZone.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            inputGambar.click();
        }
    });
    btnChangeImage?.addEventListener('click', () => inputGambar.click());

    inputGambar.addEventListener('change', e => {
        const file = e.target.files[0];
        if (file && validateImage(file)) showPreview(file);
    });

    function showPreview(file) {
        const progressBox = document.getElementById('progressBox');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        const previewInsideDropZone = dropZone.contains(previewBox);

        dropZone.style.display = 'none';
        previewBox.style.display = 'none';
        progressBox.style.display = 'block';
        progressBar.style.width = '0%';
        progressText.textContent = 'Mengupload... 0%';

        const reader = new FileReader();
        reader.onprogress = e => {
            if (e.lengthComputable) {
                const pct = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = pct + '%';
                progressText.textContent = 'Mengupload... ' + pct + '%';
            }
        };
        reader.onload = e => {
            progressBar.style.width = '100%';
            progressText.textContent = 'Selesai!';
            setTimeout(() => {
                progressBox.style.display = 'none';
                previewImg.src = e.target.result;
                previewName.textContent = file.name;
                dropZone.style.display = previewInsideDropZone ? 'block' : 'none';
                previewBox.style.display = 'block';
            }, 400);
        };
        reader.readAsDataURL(file);
    }

    document.getElementById('formBerita').addEventListener('submit', function() {
        document.querySelectorAll('button[type="submit"]').forEach(btn => btn.disabled = true);
    });
</script>
@endpush
