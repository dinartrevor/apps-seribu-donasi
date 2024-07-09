<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">SERIBU UTB</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('/*')) ? 'active' : '' }}" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('donasi*')) ? 'active' : '' }}" href="donasi.php">Donasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('about*')) ? 'active' : '' }}" href="about.php">Tentang Kami</a>
                </li>
               @if(Auth::guard('student')->user())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->is('profile*')) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $user['name'] ?> <i class="bi bi-person-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            @if (empty(Auth::guard('student')->user()->isVerify) && !empty(Auth::guard('student')->user()))
                            <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#donationModal">Buat Donasi</a></li>
                            @else
                                <li><a href="{{route('frontEnd.login')}}" class="dropdown-item">Buat Donasi</a></li>
                            @endif
                            <li><a class="dropdown-item" href="config/function/logout.php">Logout</a></li>
                        </ul>
                    </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('frontEnd.login')}}">
                        Login <i class="bi bi-person-fill"></i>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
