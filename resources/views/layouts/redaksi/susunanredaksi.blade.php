    <link rel="stylesheet" href="{{ asset('css/redaksi.css') }}">

  @extends('layouts.app')
    @section('content')

    <section class="redaksi-section">
    <div class="container">
        <div class="main-header">
            <h1 class="main-title js-reveal">SUSUNAN REDAKSI</h1>
            <h2 class="sub-title js-reveal">Pimpinan Pusat Dewan Masjid Indonesia (PP DMI)</h2>
            <div class="period-badge js-reveal">
                <span>MASA KHIDMAT 2024 - 2029</span>
            </div>
            <div class="header-line js-reveal"></div>
        </div>

        <div class="executive-wrapper js-reveal">
            <div class="card-exec">
                <div class="image-circle">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-info">
                    <h3>Dr. (H.C.) Drs. H. Muhammad Jusuf Kalla</h3>
                    <p class="role">Ketua Umum PP DMI</p>
                </div>
            </div>

            <div class="card-exec">
                <div class="image-circle">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-info">
                    <h3>Komjen. Pol. (Purn.) Dr. (H.C.) H. Syafruddin, M.Si.</h3>
                    <p class="role">Wakil Ketua Umum DMI</p>
                </div>
            </div>
        </div>

        <div class="section-label js-reveal">
            <span>Dewan Redaksi</span>
        </div>

        <div class="members-flex-container js-reveal">
            @php
                $editorial = [
                    'KH. Masdar F. Mas\'udi', 'Imam Addaruquthni', 'Sofyan Djalil', 
                    'Rudiantara', 'Husain Abdullah', 'Mahfud Shiddik', 
                    'dr Fahmi Idris', 'KH. Ahmad Bagja', 'Buyung Wijaya Kusuma'
                ];
            @endphp

            @foreach($editorial as $name)
            <div class="card-member-minimal">
                <div class="member-avatar-box">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h4>{{ $name }}</h4>
            </div>
            @endforeach
        </div>


        <br>
        <br>
        <br>
        <br>
        <div class="section-label js-reveal">
            <span>Redaktur</span>
        </div>

        <div class="members-flex-container2 js-reveal">
            @php
                $editorial = [
                    'Gatot Widakdo', 'Rony Armes',
                ];
            @endphp

            @foreach($editorial as $name)
            <div class="card-member-minimal">
                <div class="member-avatar-box">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h4>{{ $name }}</h4>
            </div>
            @endforeach
        </div>
    </div>


        <br>
        <br>
        <br>
        <br>
        <center>
        <div class="section-label js-reveal">
            <span>Reporter</span>
        </div>

        <div class="members-flex-container js-reveal">
            @php
                $editorial = [
                    'Faisal Syafrudin Sallatalohy', 'Muhammad Iqbal', 'Buchorie',
                ];
            @endphp

            @foreach($editorial as $name)
            <div class="card-member-minimal js-reveal">
                <div class="member-avatar-box">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h4>{{ $name }}</h4>
            </div>
            @endforeach
        </div>
        </center>
        


        <br>
        <br>
        <br>
        <br>
        <div class="section-label js-reveal">
            <span>Fotografer/Videografer</span>
        </div>

        <div class="members-flex-container2 js-reveal">
            @php
                $editorial = [
                    'Ishak', 'Muhammad Zen',
                ];
            @endphp

            @foreach($editorial as $name)
            <div class="card-member-minimal js-reveal">
                <div class="member-avatar-box">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h4>{{ $name }}</h4>
            </div>
            @endforeach
        </div>
    </div>


        <br>
        <br>
        <br>
        <br>
        <div class="section-label js-reveal">
            <span>Sosial Media</span>
        </div>

        <div class="members-flex-container2 js-reveal">
            @php
                $editorial = [
                    'Gita Permata', 'Shinta Lestari',
                ];
            @endphp

            @foreach($editorial as $name)
            <div class="card-member-minimal js-reveal">
                <div class="member-avatar-box">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h4>{{ $name }}</h4>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="team-section js-reveal">
    <div class="team-container js-reveal">
        <div class="team-column js-reveal">
            <h2 class="role-title">Editor</h2>
            <div class="member-card">
                <div class="icon-wrapper">
                    <i class="fas fa-user-circle"></i> </div>
                <h3 class="member-name">Muhammad Isdar</h3>
            </div>
        </div>

        <div class="team-column js-reveal">
            <h2 class="role-title">IT</h2>
            <div class="member-card js-reveal">
                <div class="icon-wrapper">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h3 class="member-name">Ahmad Fauzi Nahrony</h3>
            </div>
        </div>
    </div>
</section>

    @endsection