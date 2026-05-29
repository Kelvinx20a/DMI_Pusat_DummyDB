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
        <button type="button" class="btn btn-new-post" data-bs-toggle="modal" data-bs-target="#createEventModal">
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
                                    data-bs-toggle="modal"
                                    data-bs-target="#editEventModal"
                                    data-id="{{ $event->event_id }}"
                                    data-title="{{ $event->post->post_title ?? '' }}"
                                    data-description="{{ $event->post->post_content ?? '' }}"
                                    data-date="{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }}"
                                    data-start="{{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }}"
                                    data-end="{{ \Carbon\Carbon::parse($event->end_date)->format('H:i') }}"
                                    data-organizer="{{ $event->post->getMeta('_event_organizer') ?? '' }}"
                                    data-tempat="{{ $event->post->getMeta('_event_venue') ?? '' }}"
                                    data-image="{{ $event->getImageUrl() ?? '' }}">
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
<div class="modal fade" id="createEventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-event post-style-modal">

            <div class="modal-event-title">
                <div>
                    <span>Buat Event Baru</span>
                    <p>Isi form di bawah untuk membuat event baru</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-0">

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

                    {{-- Section: Event --}}
                    <div class="modal-section">
                        <div class="modal-section-header">Informasi Dasar</div>
                        <div class="modal-section-body">
                            <div class="modal-form-group">
                                <label>Judul Event <span class="req">*</span></label>
                                <input type="text" name="title" class="modal-form-control"
                                    placeholder="Tulis judul event yang menarik..."
                                    value="{{ old('title') }}" required>
                                @error('title')
                                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="modal-form-row-2">
                                <div class="modal-form-group">
                                    <label>Organizer</label>
                                    <input type="text" name="organizer" class="modal-form-control"
                                        placeholder="Nama penyelenggara..."
                                        value="{{ old('organizer') }}">
                                </div>
                                <div class="modal-form-group">
                                    <label>Tempat</label>
                                    <textarea name="tempat" class="modal-form-control" rows="3"
                                        placeholder="Lokasi event...">{{ old('tempat') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section: Detail Event --}}
                    <div class="modal-section">
                        <div class="modal-section-header">Detail Waktu</div>
                        <div class="modal-section-body">
                            <div class="modal-form-group">
                                <label>Tanggal <span class="req">*</span></label>
                                <input type="date" name="event_date" class="modal-form-control"
                                    value="{{ old('event_date') }}" required>
                            </div>
                            <div class="modal-form-row-2">
                                <div class="modal-form-group">
                                    <label>Waktu Mulai <span class="req">*</span></label>
                                    <input type="time" name="start_time" class="modal-form-control"
                                        value="{{ old('start_time') }}" required>
                                </div>
                                <div class="modal-form-group">
                                    <label>Waktu Selesai <span class="req">*</span></label>
                                    <input type="time" name="end_time" class="modal-form-control"
                                        value="{{ old('end_time') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-section">
                        <div class="modal-section-header">Deskripsi Event</div>
                        <div class="modal-section-body">
                            <div class="modal-form-group">
                                <label>Isi Event</label>
                                <div class="trix-wrap event-trix-wrap">
                                    <input id="create_description" type="hidden" name="description" value="{{ old('description') }}">
                                    <trix-editor input="create_description" class="custom-trix event-trix" placeholder="Jelaskan detail kegiatan..."></trix-editor>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-section">
                        <div class="modal-section-header">Foto Event</div>
                        <div class="modal-section-body">
                            <div class="modal-form-group">
                                <label>Gambar Utama</label>
                                <input type="file" id="create_image" name="event_image"
                                    accept="image/*" style="display:none"
                                    onchange="handleImageUpload(this, 'create')">
                                <div class="modal-file-label post-dropzone" id="create_dropzone" role="button" tabindex="0" onclick="document.getElementById('create_image').click()">
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
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="modal-footer form-footer border-0">
                    <button type="button" class="f-btn f-btn-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="f-btn f-btn-primary modal-btn-upload">Unggah Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL EDIT EVENT                                             --}}
{{-- ============================================================ --}}
<div class="modal fade" id="editEventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-event modal-event-edit post-style-modal">

            <div class="modal-event-title modal-event-title-edit">
                <div>
                    <span>Edit Event</span>
                    <p>Perbarui informasi event di bawah ini</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="editEventForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body p-0">

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

                    {{-- Section: Event --}}
                    <div class="modal-section">
                        <div class="modal-section-header">Informasi Dasar</div>
                        <div class="modal-section-body">
                            <div class="modal-form-group">
                                <label>Judul Event <span class="req">*</span></label>
                                <input type="text" name="title" id="edit_title" class="modal-form-control" placeholder="Tulis judul event..." required>
                            </div>
                            <div class="modal-form-row-2">
                                <div class="modal-form-group">
                                    <label>Organizer</label>
                                    <input type="text" name="organizer" id="edit_organizer" class="modal-form-control" placeholder="Nama penyelenggara...">
                                </div>
                                <div class="modal-form-group">
                                    <label>Tempat</label>
                                    <textarea name="tempat" id="edit_tempat" class="modal-form-control" rows="3" placeholder="Lokasi event..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section: Detail Event --}}
                    <div class="modal-section">
                        <div class="modal-section-header">Detail Waktu</div>
                        <div class="modal-section-body">
                            <div class="modal-form-group">
                                <label>Tanggal <span class="req">*</span></label>
                                <input type="date" name="event_date" id="edit_date" class="modal-form-control" required>
                            </div>
                            <div class="modal-form-row-2">
                                <div class="modal-form-group">
                                    <label>Waktu Mulai <span class="req">*</span></label>
                                    <input type="time" name="start_time" id="edit_start" class="modal-form-control" required>
                                </div>
                                <div class="modal-form-group">
                                    <label>Waktu Selesai <span class="req">*</span></label>
                                    <input type="time" name="end_time" id="edit_end" class="modal-form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-section">
                        <div class="modal-section-header">Deskripsi Event</div>
                        <div class="modal-section-body">
                            <div class="modal-form-group">
                                <label>Isi Event</label>
                                <div class="trix-wrap event-trix-wrap">
                                    <input id="edit_description" type="hidden" name="description">
                                    <trix-editor input="edit_description" id="edit_trix" class="custom-trix event-trix" placeholder="Jelaskan detail kegiatan..."></trix-editor>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-section">
                        <div class="modal-section-header">Foto Event</div>
                        <div class="modal-section-body">
                            <div class="modal-form-group">
                                <label>Gambar Utama</label>
                                <input type="file" id="edit_image" name="event_image"
                                    accept="image/*" style="display:none"
                                    onchange="handleImageUpload(this, 'edit')">
                                <div class="modal-file-label post-dropzone" id="edit_dropzone" role="button" tabindex="0" onclick="document.getElementById('edit_image').click()">
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
                        </div>
                    </div>

                </div>

                <div class="modal-footer form-footer border-0">
                    <button type="button" class="f-btn f-btn-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="f-btn f-btn-primary modal-btn-upload modal-btn-update">Simpan Perubahan</button>
                </div>
            </form>
        </div>
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

    document.getElementById('confirmDeleteEventModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    // Isi data ke modal Edit saat tombol diklik
    const editModal = document.getElementById('editEventModal');
    editModal.addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;

        const id          = btn.getAttribute('data-id');
        const title       = btn.getAttribute('data-title');
        const description = btn.getAttribute('data-description');
        const date        = btn.getAttribute('data-date');
        const start       = btn.getAttribute('data-start');
        const end         = btn.getAttribute('data-end');
        const organizer   = btn.getAttribute('data-organizer');
        const tempat      = btn.getAttribute('data-tempat');
        const image       = btn.getAttribute('data-image');

        // Set action form
        document.getElementById('editEventForm').action = `/admin/events/${id}`;

        // Isi semua field
        document.getElementById('edit_title').value       = title;
        document.getElementById('edit_description').value = description || '';
        document.querySelector('#edit_trix')?.editor.loadHTML(description || '');
        document.getElementById('edit_date').value        = date;
        document.getElementById('edit_start').value       = start;
        document.getElementById('edit_end').value         = end;
        document.getElementById('edit_organizer').value   = organizer;
        document.getElementById('edit_tempat').value      = tempat;

        // Tampilkan preview foto lama jika ada
        const preview    = document.getElementById('edit_preview_wrap');
        const previewImg = document.getElementById('edit_preview_img');
        const placeholder = document.getElementById('edit_dropzone_placeholder');
        if (image) {
            previewImg.src    = image;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        } else {
            preview.style.display = 'none';
            placeholder.style.display = 'block';
        }
    });

    

    // Auto buka modal jika ada error validasi
    @if($errors->any() && old('_form') === 'create')
        new bootstrap.Modal(document.getElementById('createEventModal')).show();
    @endif

    @if($errors->any() && old('_form') === 'edit')
        new bootstrap.Modal(document.getElementById('editEventModal')).show();
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
