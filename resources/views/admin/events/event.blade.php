@extends('admin.layout.layout_admin')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('admin/css/event.css') }}">
@endpush

@section('content')
<div class="all-post-container p-4">

    <div class="mobile-search">
        <i class='bx bx-search'></i>
        <input type="text" id="eventMobileSearch" 
               placeholder="Cari event..."
               value="{{ request('search') }}">
    </div>  

    {{-- Header --}}
    <div class="header-wrapper">
        <div class="page-heading">
            <h4 class="m-0 text-dark">Event</h4>
        </div>
        <button type="button" class="btn btn-new-post" onclick="openCreateEventModal()">
            <i class="fas fa-plus me-2"></i> NEW EVENT
        </button>
    </div>

    {{-- Table --}}
    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">IMAGE</th>
                        <th>EVENT TITLE</th>
                        <th>DESCRIPTION</th>
                        <th>DATE</th>
                        <th>STATUS</th>
                        <th class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td class="ps-4">
                            <div class="img-wrapper">
                                @php $imgUrl = $event->getImageUrl(); @endphp
                                <img src="{{ $imgUrl ?? asset('admin-assets/img/logo dmi.png') }}"
                                     class="img-thumbnail-post"
                                     style="object-fit: {{ $imgUrl ? 'cover' : 'contain' }}; padding: {{ $imgUrl ? '0' : '5px' }};">
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-dark d-block">
                                {{ Str::limit($event->post->post_title ?? 'Untitled Event', 40) }}
                            </span>
                            <small class="text-muted">
                                {{ $event->post->getMeta('_event_organizer') ? 'Oleh: ' . $event->post->getMeta('_event_organizer') : '' }}
                            </small>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ Str::limit(strip_tags($event->post->post_content ?? ''), 60) }}
                            </small>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark" style="font-size:13px;">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                            </div>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }}
                                s/d {{ \Carbon\Carbon::parse($event->end_date)->format('H:i') }}
                            </small>
                        </td>
                        <td>
                            @php
                                $now   = now();
                                $start = \Carbon\Carbon::parse($event->start_date);
                                $end   = \Carbon\Carbon::parse($event->end_date);
                            @endphp
                            @if($now->between($start, $end))
                                <span class="status-badge status-publish">Berlangsung</span>
                            @elseif($now->lt($start))
                                <span class="status-badge status-draft">Upcoming</span>
                            @else
                                <span class="status-badge status-trash">Selesai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="action-btns">
                                @if(($event->post->post_status ?? null) === 'publish')
                                    <a href="{{ $event->getDetailUrl() }}" class="btn-action view" title="Lihat Tampilan User" target="_blank" rel="noopener">
                                        <i class="bx bx-show"></i>
                                    </a>
                                @endif

                                {{-- Tombol Edit --}}
                                <button type="button" class="btn-action edit" title="Edit"
                                    onclick="openEditEventModal({{ $event->event_id }})">
                                    <i class="bx bx-edit"></i>
                                </button>

                                {{-- Tombol Delete --}}
                                <button type="button" class="btn-action delete" title="Hapus"
                                    onclick="openDeleteModal(
                                        '{{ route('events.destroy', $event->event_id) }}',
                                        '{{ addslashes($event->post->post_title ?? 'Untitled Event') }}'
                                    )">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="pagination-footer">
        <div class="pagination-info">
            Showing <b>{{ $events->firstItem() }}</b> to <b>{{ $events->lastItem() }}</b>
            of <b>{{ $events->total() }}</b> results
        </div>
        <nav class="custom-pagination">
            {{ $events->onEachSide(1)->links('pagination::bootstrap-4') }}
        </nav>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL CONFIRM DELETE EVENT                                   --}}
{{-- ============================================================ --}}
<div class="modal-overlay" id="confirmDeleteEventModal">
    <div class="modal-box">
        <div class="modal-icon modal-icon-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0
                    01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V5a1 1 0
                    011-1h6a1 1 0 011 1v2"/>
            </svg>
        </div>
        <h3 class="modal-title">Hapus Event</h3>
        <p class="modal-message">Apakah Anda yakin ingin menghapus event
            <strong id="deleteEventName"></strong>?
            Tindakan ini tidak dapat dibatalkan.</p>
        <div class="modal-actions">
            <button class="modal-btn modal-btn-secondary" type="button" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteEventForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal-btn modal-btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL CREATE EVENT                                           --}}
{{-- ============================================================ --}}
<div class="modal-overlay" id="createEventModal">
    <div class="modal-box modal-box-event">

        <div class="modal-header">
            <h3 class="modal-title">Buat Event Baru</h3>
            <button type="button" class="modal-close" onclick="closeEventModal('createEventModal')">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="modal-form">
            @csrf

            {{-- Error validasi --}}
            @if($errors->any() && old('_form') === 'create')
                <div class="modal-alert-error">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="_form" value="create">

            {{-- Judul --}}
            <div class="form-group">
                <label class="form-label">Judul Event <span class="required">*</span></label>
                <input type="text" name="title" class="form-input"
                    placeholder="Tulis judul event yang menarik..."
                    value="{{ old('title') }}" required>
                @error('title')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- Organizer + Tempat --}}
            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label">Organizer</label>
                    <input type="text" name="organizer" class="form-input"
                        placeholder="Nama penyelenggara..."
                        value="{{ old('organizer') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Tempat</label>
                    <textarea name="tempat" class="form-input" rows="3"
                        placeholder="Lokasi event...">{{ old('tempat') }}</textarea>
                </div>
            </div>

            {{-- Tanggal --}}
            <div class="form-group">
                <label class="form-label">Tanggal <span class="required">*</span></label>
                <input type="date" name="event_date" class="form-input"
                    value="{{ old('event_date') }}" required>
            </div>

            {{-- Start time + End time --}}
            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label">Waktu Mulai <span class="required">*</span></label>
                    <input type="time" name="start_time" class="form-input"
                        value="{{ old('start_time') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Selesai <span class="required">*</span></label>
                    <input type="time" name="end_time" class="form-input"
                        value="{{ old('end_time') }}" required>
                </div>
            </div>

            {{-- Trix (DIAM, sesuai instruksi user) --}}
            <div class="form-group">
                <label class="form-label">Deskripsi Event</label>
                <div class="trix-wrap event-trix-wrap">
                    <input id="create_description" type="hidden" name="description" value="{{ old('description') }}">
                    <trix-editor input="create_description" class="custom-trix event-trix" placeholder="Jelaskan detail kegiatan..."></trix-editor>
                </div>
            </div>

            {{-- Foto --}}
            <div class="form-group">
                <label class="form-label">Gambar Utama</label>
                <input type="file" id="create_image" name="event_image"
                    accept="image/*" style="display:none"
                    onchange="handleImageUpload(this, 'create')">
                <div class="post-dropzone" id="create_dropzone" role="button" tabindex="0" onclick="document.getElementById('create_image').click()">
                    <div id="create_dropzone_placeholder">
                        <p class="drop-text">Drag & drop gambar atau <span>pilih file</span></p>
                        <p class="drop-hint">JPG, PNG, WEBP - Maksimal 10MB</p>
                    </div>
                    <div id="create_preview_wrap" class="modal-image-preview" style="display:none;">
                        <img id="create_preview_img" src="" alt="Preview Foto">
                        <div class="img-preview-btns">
                            <button type="button" class="img-btn-remove" onclick="event.stopPropagation(); removePreview('create')">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeEventModal('createEventModal')">Batal</button>
                <button type="submit" class="btn-submit">Unggah Event</button>
            </div>

        </form>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL EDIT EVENT                                             --}}
{{-- ============================================================ --}}
<div class="modal-overlay" id="editEventModal">
    <div class="modal-box modal-box-event">

        <div class="modal-header">
            <h3 class="modal-title">Edit Event</h3>
            <button type="button" class="modal-close" onclick="closeEventModal('editEventModal')">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="editEventForm" method="POST" enctype="multipart/form-data" class="modal-form">
            @csrf
            @method('PUT')

            @if($errors->any() && old('_form') === 'edit')
                <div class="modal-alert-error">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="_form" value="edit">
            <input type="hidden" name="event_id" id="edit_event_id" value="{{ old('event_id') }}">

            <div class="form-group">
                <label class="form-label">Judul Event <span class="required">*</span></label>
                <input type="text" name="title" id="edit_title" class="form-input" placeholder="Tulis judul event..." required>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label">Organizer</label>
                    <input type="text" name="organizer" id="edit_organizer" class="form-input" placeholder="Nama penyelenggara...">
                </div>
                <div class="form-group">
                    <label class="form-label">Tempat</label>
                    <textarea name="tempat" id="edit_tempat" class="form-input" rows="3" placeholder="Lokasi event..."></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal <span class="required">*</span></label>
                <input type="date" name="event_date" id="edit_date" class="form-input" required>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label">Waktu Mulai <span class="required">*</span></label>
                    <input type="time" name="start_time" id="edit_start" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Selesai <span class="required">*</span></label>
                    <input type="time" name="end_time" id="edit_end" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Event</label>
                <div class="trix-wrap event-trix-wrap">
                    <input id="edit_description" type="hidden" name="description">
                    <trix-editor input="edit_description" id="edit_trix" class="custom-trix event-trix" placeholder="Jelaskan detail kegiatan..."></trix-editor>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Utama</label>
                <input type="file" id="edit_image" name="event_image"
                    accept="image/*" style="display:none"
                    onchange="handleImageUpload(this, 'edit')">
                <div class="post-dropzone" id="edit_dropzone" role="button" tabindex="0" onclick="document.getElementById('edit_image').click()">
                    <div id="edit_dropzone_placeholder">
                        <p class="drop-text">Drag & drop gambar atau <span>pilih file</span></p>
                        <p class="drop-hint">JPG, PNG, WEBP - Maksimal 10MB</p>
                    </div>
                    <div id="edit_preview_wrap" class="modal-image-preview" style="display:none;">
                        <img id="edit_preview_img" src="" alt="Preview Foto">
                        <div class="img-preview-btns">
                            <button type="button" class="img-btn-remove" onclick="event.stopPropagation(); removePreview('edit')">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeEventModal('editEventModal')">Batal</button>
                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </div>

        </form>
    </div>
</div>

@endsection

@push('after-script')
<script>

    function handleImageUpload(input, prefix) {
        if (!input.files || !input.files[0]) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(prefix + '_preview_img').src = e.target.result;
            document.getElementById(prefix + '_preview_wrap').style.display = 'block';
            document.getElementById(prefix + '_dropzone_placeholder').style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }

    function removePreview(prefix) {
        document.getElementById(prefix + '_preview_img').src = '';
        document.getElementById(prefix + '_preview_wrap').style.display = 'none';
        document.getElementById(prefix + '_dropzone_placeholder').style.display = 'block';
        document.getElementById(prefix + '_image').value = '';
    }

    function openDeleteModal(actionUrl, eventName) {
        document.getElementById('deleteEventName').textContent = eventName;
        document.getElementById('deleteEventForm').action = actionUrl;
        document.getElementById('confirmDeleteEventModal').classList.add('active');
    }

    function closeDeleteModal() {
        document.getElementById('confirmDeleteEventModal').classList.remove('active');
    }

    // ---- EVENT MODAL FUNCTIONS ----

    function openCreateEventModal() {
        document.getElementById('createEventModal').classList.add('active');
    }

    function openEditEventModal(id) {
        fetch('/admin/events/' + id + '/edit', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(response => {
            if (!response.ok) throw new Error('Response not OK');
            return response.json();
        })
        .then(data => {
            document.getElementById('editEventForm').action = '/admin/events/' + data.id;
            document.getElementById('edit_event_id').value = data.id;
            document.getElementById('edit_title').value = data.title || '';
            document.getElementById('edit_description').value = data.description || '';
            document.querySelector('#edit_trix')?.editor.loadHTML(data.description || '');
            document.getElementById('edit_date').value = data.date || '';
            document.getElementById('edit_start').value = data.start_time || '';
            document.getElementById('edit_end').value = data.end_time || '';
            document.getElementById('edit_organizer').value = data.organizer || '';
            document.getElementById('edit_tempat').value = data.tempat || '';

            var preview = document.getElementById('edit_preview_wrap');
            var previewImg = document.getElementById('edit_preview_img');
            var placeholder = document.getElementById('edit_dropzone_placeholder');
            if (data.image) {
                previewImg.src = data.image;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            } else {
                preview.style.display = 'none';
                placeholder.style.display = 'block';
            }

            document.getElementById('editEventModal').classList.add('active');
        })
        .catch(function(error) {
            console.error('Error loading event:', error);
        });
    }

    function closeEventModal(id) {
        document.getElementById(id).classList.remove('active');
    }

    // Close on overlay click
    document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
    });

    // Auto buka modal jika ada error validasi
    @if($errors->any() && old('_form') === 'create')
        document.addEventListener('DOMContentLoaded', function() {
            openCreateEventModal();
        });
    @endif

    @if($errors->any() && old('_form') === 'edit')
        document.addEventListener('DOMContentLoaded', function() {
            var editId = document.getElementById('edit_event_id').value;
            if (editId) openEditEventModal(editId);
        });
    @endif

    document.addEventListener('DOMContentLoaded', function () {

        const mobileEventSearch = document.getElementById('eventMobileSearch');
        let mobileTimer;

        if (mobileEventSearch) {
            mobileEventSearch.addEventListener('keyup', function() {
                clearTimeout(mobileTimer);
                const keyword = this.value;

                mobileTimer = setTimeout(() => {
                    const url = new URL(window.location.href);

                    if (keyword.trim() !== '') {
                        url.searchParams.set('search', keyword);
                    } else {
                        url.searchParams.delete('search');
                    }

                    window.location.href = url.toString();
                }, 800);
            });
        }

        let desktopTimer;
        const desktopSearch = document.getElementById('desktopSearch');

        if (desktopSearch) {
            desktopSearch.addEventListener('keyup', function() {
                clearTimeout(desktopTimer);
                const keyword = this.value;

                desktopTimer = setTimeout(() => {
                    const url = new URL(window.location.href);

                    if (keyword.trim() !== '') {
                        url.searchParams.set('search', keyword);
                    } else {
                        url.searchParams.delete('search');
                    }

                    window.location.href = url.toString();
                }, 800);
            });
        }

    });
    </script>

@endpush    
