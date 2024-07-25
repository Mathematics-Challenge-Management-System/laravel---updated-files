@extends('layouts.app',['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Challenge Creation'])

<div class="card shadow-lg mx-4 card-school-bottom">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="/images/pupil.jpg" alt="school_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">

                    <p class="mb-0 font-weight-bold text-sm">

                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                                <h1>MCMS</h1>

                        </li>
                        <li class="nav-item">
                            <h3>Numbers don't lie!!</h3>

                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="alert">
    @include('components.alert')
</div>

<!-- Display success message if any -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Add a link to create a new challenge -->

<!-- Check if there are any challenges -->
@if($allChallenges->count() > 0)
    <div class="card max-w-5xl mx-auto text-center m-4">
        <a href="{{ route('challenges.create') }}" class="btn  btn-primary mb-3">Create New Challenge</a>

        <h1>Challenges</h1>
        <div class="card-body" >
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Wrong Answer</th>
                        <th>Blank Answer</th>
                        <th>Questions to Answer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allChallenges as $challenge)
                        <tr>
                            <td>{{ $challenge->challenge_name }}</td>
                            <td>{{ $challenge->challenge_start_date }}</td>
                            <td>{{ $challenge->challenge_end_date }}</td>
                            <td>{{ $challenge->wrong_answer_marks }}</td>
                            <td>{{ $challenge->blank_answer_marks }}</td>
                            <td>{{ $challenge->questions_to_answer }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <p>No challenges found.</p>
@endif

@include('layouts.footers.auth.footer')


</body>
<footer style="background-color: #f0f0f0; padding: 10px; text-align: center;">
    <p>&copy;Mathematics challenge Competition. Numbers Dont Lie</p>
</footer>
</html>
@endsection

