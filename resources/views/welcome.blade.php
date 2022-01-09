@extends('layouts.myapp')

@section('content')
    <section class="hero-home">
        <div class="container px-5 px-lg-3 py-5">
            <div class="content-hero d-flex align-items-center flex-column flex-lg-row">
                <div class="text-hero">
                    <h1 class="fw-bold">Kelola Project mu dengan mudah</h1>
                    <p>Koordinasi antar tim. Kelola semua pekerjaanmu dengan POMAS. Easy. Together. simpel </p>
                </div>
                <div class="space-kosong w-25"></div>
            <img src="{{ asset('img/Saly-19.png') }}" alt="gambar-sally">
            </div>
        </div>
    </section>

    <section class="why-home">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 px-5">
                    <div class="why-text mx-auto">
                        <h2 class="fw-bold text-center text-white">Apa itu Project management ?</h2>
                        <p class="text-center text-white" style="line-height: 2rem">Manajemen project merupakan usaha pengerjaan suatu proyek yang dibatasi oleh anggaran, jadwal, dan mutu dengan tujuan tercapainya proyek tersebut secara efisien dan efektif.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 p-5">
                    <div class="card">
                        <div class="card-body p-3 p-lg-5">
                            <h3 class="card-title fw-medium">Kenapa butuh POMAS ? </h3>
                            <ul>
                                <li class="mb-3">Mudah di akses</li>
                                <li class="mb-3">Mudah di gunakan</li>
                                <li class="mb-3">Membantu pekerjaan lebih cepat</li>
                            </ul>
                            <img src="{{ asset('img/Saly-38.png') }}" alt="sally-38" class="w-100">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 p-5">
                    <div class="card">
                        <div class="card-body p-3 p-lg-5">
                            <h3 class="card-title fw-medium">Kenapa butuh POMAS ? </h3>
                            <ul>
                                <li class="mb-3">Mudah di akses</li>
                                <li class="mb-3">Mudah di gunakan</li>
                                <li class="mb-3">Membantu pekerjaan lebih cepat</li>
                            </ul>
                            <img src="{{ asset('img/Saly-13.png') }}" alt="sally-13" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="hero-home">
        <div class="container px-5 px-lg-3 py-5">
            <div class="content-hero d-flex align-items-center flex-column flex-lg-row">
                <div class="text-hero">
                    <h1 class="fw-bold">Atur Proyek mu yang akan datang</h1>
                    <p>Banyak proyek gagal karena kurang di kelola dengan baik. jangan sampai terjadi kepada proyek mu.</p>
                    <a href="{{ route('register') }}" class="btn btn-lg btn-outline-primary">Daftar Segera</a>
                </div>
                <div class="space-kosong w-25"></div>
            <img src="{{ asset('img/Saly-11.png') }}" alt="gambar-sally">
            </div>
        </div>
    </section>

    <section class="slogan-home">
        <div class="container py-5 px-5">
            <div class="slogan-content d-flex align-items-center flex-column mx-auto">
                <h1 class="text-white fw-bold text-center">POMAS</h1>
                <h1 class="text-white fw-bold text-center">Solusi Andalan Proyekmu</h1>
                <div class="divider mt-5"></div>
                <img src="{{ asset('img/Saly-24.png') }}" alt="sally-24">
            </div>
        </div>
    </section>

@endsection


{{--

@auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-lg btn-danger">Logout</button>
            </form>
            @else
            <p><a href="{{ route('login') }}">Go to Login</a></p>
        @endauth

 --}}
