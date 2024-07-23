
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Schools-Information'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Schools Information</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <h1>Schools</h1>
                            
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <p>Welcome, Gloria Rugambwa</p>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            @if($school_representative->count() > 0)
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>School Name</th>
                                            <th>School District</th>
                                            <th>School RegNo</th>
                                            <th>School phone</th>
                                            <th>Representative Firstname</th>
                                            <th>Representative Lastname</th>
                                            <th>Representative Email</th>
                                            <th>Representative password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($school_representative as $school)
                                            <tr>
                                                <td>{{ $school->school_name }}</td>
                                                <td>{{ $school->school_district }}</td>
                                                <td>{{ $school->school_regNo }}</td>
                                                <td>{{ $school->school_phone }}</td>
                                                <td>{{ $school->representative_firstname }}</td>
                                                <td>{{ $school->representative_lastname }}</td>
                                                <td>{{ $school->representative_email }}</td>
                                                <td>{{ $school->rep_password }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No schools found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
@endpush