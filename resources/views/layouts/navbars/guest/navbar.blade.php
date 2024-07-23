<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <nav style="background-color: #252a48; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);"
                class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                <div class="container-fluid">
                   <img src="/images/math.png" alt="Logo" style="width: 30px; height: 30px; margin-right: 10px;">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ route('home') }}" style="font-size: 20px; color: #ffa07a;">
                        MATHEMATICS CHALLENGE COMPETITION
                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                                    href="{{ route('home') }}" style="color: #ffa07a;">
                                    <i class="fa fa-chart-pie opacity-6 me-1" style="color: #ffa07a;"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-2" href="{{ route('register') }}" style="color: #ffa07a;">
                                    <i class="fas fa-user-circle opacity-6 me-1" style="color: #ffa07a;"></i>
                                    Register
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-2" href="{{ route('login') }}" style="color: #ffa07a;">
                                    <i class="fas fa-key opacity-6 me-1" style="color: #ffa07a;"></i>
                                    Log In
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>