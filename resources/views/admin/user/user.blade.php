@extends('admin.layout.layout_admin')

@push('after-style')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endpush

@section('content')
<div class="users-page">

    <div class="page-header">
        <h1 class="page-title">Users</h1>
        <button type="button" class="btn-add-user" onclick="openCreateModal()">NEW USER</button>
    </div>

    <div class="table-wrapper">
        <table class="users-table">
            <thead>
                <tr>
                    <th>IMAGE</th>
                    <th>USERNAME</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th>POSTS</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="user-row">

                    <td class="td-image">
                        <img
                            src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->user_email))) }}?s=48&d=mm"
                            alt="{{ $user->user_login }}"
                            class="user-avatar"
                        >
                    </td>
                    <td class="td-username">{{ $user->user_login }}</td>
                    <td class="td-name">{{ $user->display_name ?: '-' }}</td>
                    <td class="td-email">{{ $user->user_email ?: '-' }}</td>
                    <td class="td-role">
                        <span class="role-badge role-{{ strtolower($user->role_label) }}">
                            {{ $user->role_label }}
                        </span>
                    </td>
                    <td class="td-posts">{{ $user->posts_count }}</td>
                    <td class="td-actions">
                        <button type="button" class="btn-action btn-edit" title="Edit"
                            onclick="openEditModal({{ $user->ID }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0
                                    002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </button>

                        @if($user->ID === auth()->id())
                            <button type="button" class="btn-action btn-delete"
                                onclick="showCannotDeleteModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0
                                        01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V5a1 1 0
                                        011-1h6a1 1 0 011 1v2"/>
                                </svg>
                            </button>
                        @else
                            <button type="button" class="btn-action btn-delete"
                                onclick="showConfirmDeleteModal('{{ $user->user_login }}', '{{ route('user.destroy', $user->ID) }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0
                                        01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V5a1 1 0
                                        011-1h6a1 1 0 011 1v2"/>
                                </svg>
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-state">Tidak ada user ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $users->appends(request()->query())->links() }}
    </div>

</div>

<!-- MODAL CREATE -->
<div class="modal-overlay" id="createUserModal">
    <div class="modal-box modal-box-large">

        <div class="modal-header">
            <h3 class="modal-title">Create User</h3>
            <button type="button" class="modal-close" onclick="closeModal('createUserModal')">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('user.store') }}" class="modal-form">
            @csrf

            {{-- Username --}}
            <div class="form-group">
                <label for="user_login" class="form-label">
                    Username <span class="required">*</span>
                </label>
                <input
                    type="text"
                    id="user_login"
                    name="user_login"
                    class="form-input @error('user_login') input-error @enderror"
                    placeholder="Masukkan username..."
                    value="{{ old('user_login') }}"
                    required
                >
                @error('user_login')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="user_email" class="form-label">
                    Email <span class="required">*</span>
                </label>
                <input
                    type="email"
                    id="user_email"
                    name="user_email"
                    class="form-input @error('user_email') input-error @enderror"
                    placeholder="Masukkan email..."
                    value="{{ old('user_email') }}"
                    required
                >
                @error('user_email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Display Name --}}
            <div class="form-group">
                <label for="display_name" class="form-label">Display Name</label>
                <input
                    type="text"
                    id="display_name"
                    name="display_name"
                    class="form-input @error('display_name') input-error @enderror"
                    placeholder="Masukkan display name..."
                    value="{{ old('display_name') }}"
                >
                @error('display_name')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="user_pass" class="form-label">
                    Password <span class="required">*</span>
                </label>
                <div class="input-password-wrapper">
                    <input
                        type="password"
                        id="user_pass"
                        name="user_pass"
                        class="form-input @error('user_pass') input-error @enderror"
                        placeholder="Masukkan password..."
                        required
                    >
                    <button type="button" class="btn-toggle-password" onclick="togglePassword()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943
                                9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('user_pass')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
                <p class="form-hint">Minimal 6 karakter.</p>
            </div>

            {{-- Role --}}
            <div class="form-group">
                <label class="form-label">Role <span class="required">*</span></label>
                <div class="role-options">

                    <label class="role-option {{ old('user_status', '0') == '0' ? 'active' : '' }}">
                        <input type="radio" name="user_status" value="0"
                            {{ old('user_status', '0') == '0' ? 'checked' : '' }}>
                        <div class="role-option-content">
                            <span class="role-dot role-dot-subscriber"></span>
                            <div>
                                <span class="role-name">Subscriber</span>
                                <span class="role-desc">Hanya dapat membaca konten</span>
                            </div>
                        </div>
                    </label>

                    <label class="role-option {{ old('user_status') == '1' ? 'active' : '' }}">
                        <input type="radio" name="user_status" value="1"
                            {{ old('user_status') == '1' ? 'checked' : '' }}>
                        <div class="role-option-content">
                            <span class="role-dot role-dot-editor"></span>
                            <div>
                                <span class="role-name">Editor</span>
                                <span class="role-desc">Dapat membuat dan mengelola konten</span>
                            </div>
                        </div>
                    </label>

                    <label class="role-option {{ old('user_status') == '2' ? 'active' : '' }}">
                        <input type="radio" name="user_status" value="2"
                            {{ old('user_status') == '2' ? 'checked' : '' }}>
                        <div class="role-option-content">
                            <span class="role-dot role-dot-administrator"></span>
                            <div>
                                <span class="role-name">Administrator</span>
                                <span class="role-desc">Akses penuh ke seluruh sistem</span>
                            </div>
                        </div>
                    </label>

                </div>
                @error('user_status')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn-cancel"
                    onclick="closeModal('createUserModal')">Batal</button>
                <button type="submit" class="btn-submit">Simpan User</button>
            </div>

        </form>
    </div>
</div>

{{-- Modal: Tidak bisa hapus akun aktif --}}
<div class="modal-overlay" id="cannotDeleteModal">
    <div class="modal-box">
        <div class="modal-icon modal-icon-warning">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0
                    001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            </svg>
        </div>
        <h3 class="modal-title">Tidak Dapat Dihapus</h3>
        <p class="modal-message">Anda tidak dapat menghapus akun ini karena sedang aktif digunakan.</p>
        <div class="modal-actions">
            <button class="modal-btn modal-btn-primary"
                onclick="closeModal('cannotDeleteModal')">Mengerti</button>
        </div>
    </div>
</div>

{{-- Modal: Konfirmasi hapus user --}}
<div class="modal-overlay" id="confirmDeleteModal">
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
        <h3 class="modal-title">Hapus User</h3>
        <p class="modal-message">Apakah Anda yakin ingin menghapus user
            <strong id="deleteUsername"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="modal-actions">
            <button class="modal-btn modal-btn-secondary"
                onclick="closeModal('confirmDeleteModal')">Batal</button>
            <form id="deleteForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal-btn modal-btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal-overlay" id="editUserModal">
    <div class="modal-box modal-box-large">

        <div class="modal-header">
            <h3 class="modal-title">Edit User</h3>
            <button type="button" class="modal-close" onclick="closeModal('editUserModal')">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form method="POST" id="editUserForm" class="modal-form">
            @csrf
            @method('PUT')

            {{-- Username --}}
            <div class="form-group">
                <label for="edit_user_login" class="form-label">
                    Username <span class="required">*</span>
                </label>
                <input
                    type="text"
                    id="edit_user_login"
                    name="user_login"
                    class="form-input"
                    placeholder="Masukkan username..."
                    required
                >
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="edit_user_email" class="form-label">
                    Email <span class="required">*</span>
                </label>
                <input
                    type="email"
                    id="edit_user_email"
                    name="user_email"
                    class="form-input"
                    placeholder="Masukkan email..."
                    required
                >
            </div>

            {{-- Display Name --}}
            <div class="form-group">
                <label for="edit_display_name" class="form-label">Display Name</label>
                <input
                    type="text"
                    id="edit_display_name"
                    name="display_name"
                    class="form-input"
                    placeholder="Masukkan display name..."
                >
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="edit_user_pass_current" class="form-label">Password Saat Ini</label>
                <div class="input-password-wrapper">
                    <input
                        type="password"
                        id="edit_user_pass_current"
                        class="form-input input-readonly"
                        readonly
                    >
                    <p class="form-hint">Password tidak ditampilkan demi keamanan. Isi "Password Baru" jika ingin menggantinya.</p>
                </div>
                <p class="form-hint">Password tersimpan dalam format terenkripsi.</p>
            </div>

            {{-- Password Baru --}}
            <div class="form-group">
                <label for="edit_user_pass" class="form-label">Password Baru</label>
                <div class="input-password-wrapper">
                    <input
                        type="password"
                        id="edit_user_pass"
                        name="user_pass"
                        class="form-input"
                        placeholder="Kosongkan jika tidak ingin mengubah password"
                    >
                    <button type="button" class="btn-toggle-password" onclick="toggleEditPassword()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943
                                9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                <p class="form-hint">Kosongkan jika tidak ingin mengubah password.</p>
            </div>
             

            {{-- Role --}}
            <div class="form-group">
                <label class="form-label">Role <span class="required">*</span></label>
                <div class="role-options" id="editRoleOptions">

                    <label class="role-option" data-value="0">
                        <input type="radio" name="user_status" value="0">
                        <div class="role-option-content">
                            <span class="role-dot role-dot-subscriber"></span>
                            <div>
                                <span class="role-name">Subscriber</span>
                                <span class="role-desc">Hanya dapat membaca konten</span>
                            </div>
                        </div>
                    </label>

                    <label class="role-option" data-value="1">
                        <input type="radio" name="user_status" value="1">
                        <div class="role-option-content">
                            <span class="role-dot role-dot-editor"></span>
                            <div>
                                <span class="role-name">Editor</span>
                                <span class="role-desc">Dapat membuat dan mengelola konten</span>
                            </div>
                        </div>
                    </label>

                    <label class="role-option" data-value="2">
                        <input type="radio" name="user_status" value="2">
                        <div class="role-option-content">
                            <span class="role-dot role-dot-administrator"></span>
                            <div>
                                <span class="role-name">Administrator</span>
                                <span class="role-desc">Akses penuh ke seluruh sistem</span>
                            </div>
                        </div>
                    </label>

                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn-cancel"
                    onclick="closeModal('editUserModal')">Batal</button>
                <button type="submit" class="btn-update">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>

    // =========================================
    // OPEN MODAL
    // =========================================

    function openCreateModal() {

        document
            .getElementById('createUserModal')
            .classList.add('active');

    }

    function openEditModal(userId) {

        fetch(`/admin/users/${userId}/edit`, {

            method: 'GET',

            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }

        })

        .then(response => {

            if (!response.ok) {
                throw new Error(
                    'Gagal mengambil data user. Status: '
                    + response.status
                );
            }

            return response.json();

        })

        .then(user => {

            // ===============================
            // INPUT VALUE
            // ===============================

            document.getElementById('edit_user_login').value =
                user.user_login ?? '';

            document.getElementById('edit_user_email').value =
                user.user_email ?? '';

            document.getElementById('edit_display_name').value =
                user.display_name ?? '';

            document.getElementById('edit_user_pass_current').value =
                '••••••••••••';

            document.getElementById('edit_user_pass').value = '';


            // ===============================
            // FORM ACTION
            // ===============================

            document.getElementById('editUserForm').action =
                `/admin/users/${user.ID}`;


            // ===============================
            // ROLE ACTIVE
            // ===============================

            const status = String(user.user_status);

            document
                .querySelectorAll('#editRoleOptions .role-option')
                .forEach(function(option) {

                    option.classList.remove('active');

                    const radio =
                        option.querySelector(
                            'input[type="radio"]'
                        );

                    if (radio.value === status) {

                        radio.checked = true;

                        option.classList.add('active');

                    } else {

                        radio.checked = false;

                    }

                });


            // ===============================
            // OPEN MODAL
            // ===============================

            document
                .getElementById('editUserModal')
                .classList.add('active');

        })

        .catch(error => {

            console.error(
                'Error edit user:',
                error
            );

            alert('Gagal memuat data user.');

        });

    }


    // =========================================
    // DELETE MODAL
    // =========================================

    function showCannotDeleteModal() {

        document
            .getElementById('cannotDeleteModal')
            .classList.add('active');

    }

    function showConfirmDeleteModal(
        username,
        actionUrl
    ) {

        document
            .getElementById('deleteUsername')
            .textContent = username;

        document
            .getElementById('deleteForm')
            .action = actionUrl;

        document
            .getElementById('confirmDeleteModal')
            .classList.add('active');

    }


    // =========================================
    // CLOSE MODAL
    // =========================================

    function closeModal(id) {

        document
            .getElementById(id)
            .classList.remove('active');

    }


    // =========================================
    // CLOSE IF CLICK OVERLAY
    // =========================================

    document
        .querySelectorAll('.modal-overlay')
        .forEach(function(overlay) {

            overlay.addEventListener(
                'click',
                function(e) {

                    if (e.target === this) {

                        this.classList.remove('active');

                    }

                }
            );

        });


    // =========================================
    // PASSWORD TOGGLE
    // =========================================

    function togglePassword() {

        const input =
            document.getElementById('user_pass');

        input.type =
            input.type === 'password'
                ? 'text'
                : 'password';

    }

    function toggleEditPassword() {

        const input =
            document.getElementById('edit_user_pass');

        input.type =
            input.type === 'password'
                ? 'text'
                : 'password';

    }


    // =========================================
    // ROLE ACTIVE - CREATE MODAL
    // =========================================

    document
        .querySelectorAll(
            '#createUserModal .role-option'
        )
        .forEach(function(option) {

            option.addEventListener(
                'click',
                function() {

                    document
                        .querySelectorAll(
                            '#createUserModal .role-option'
                        )
                        .forEach(function(el) {

                            el.classList.remove('active');

                        });

                    this.classList.add('active');

                    this.querySelector(
                        'input[type="radio"]'
                    ).checked = true;

                }
            );

        });


    // =========================================
    // ROLE ACTIVE - EDIT MODAL
    // =========================================

    document
        .querySelectorAll(
            '#editRoleOptions .role-option'
        )
        .forEach(function(option) {

            option.addEventListener(
                'click',
                function() {

                    document
                        .querySelectorAll(
                            '#editRoleOptions .role-option'
                        )
                        .forEach(function(el) {

                            el.classList.remove('active');

                        });

                    this.classList.add('active');

                    this.querySelector(
                        'input[type="radio"]'
                    ).checked = true;

                }
            );

        });


    // =========================================
    // AUTO OPEN CREATE MODAL
    // VALIDATION ERROR
    // =========================================

    @if($errors->any())

        document.addEventListener(
            'DOMContentLoaded',
            function() {

                openCreateModal();

            }
        );

    @endif

</script>
@endpush