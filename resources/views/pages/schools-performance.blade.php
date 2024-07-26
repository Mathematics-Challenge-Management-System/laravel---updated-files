@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')


    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
    <body style="background-image: url('/images/pupil 7 (2).jpg');">
    <div class="container">

            <div class="col-md-8 mx-auto">
                <div class="card mb-4">
                    <div class="p-4 ">
                        <div class="d-flex justify-content-center">
                            <h1 class="text-center ">Schools Performance By Challenge</h1>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h6 class="text-center mb-2">Select Challenge to view school performance </h6>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 offset-md-3">
                                <form class=" mx-auto text-center" method="POST" action="{{route('schools-performance.show')}}">

                                    @csrf
                                    <label class="" for="challenge_name">Select Challenge</label>
                                    {{--                            //use a select input type--}}
                                    <select id="challenge_name" name="challenge_name" class="form-select mx-auto w-40 " aria-label="Default select example">
                                        @if(isset($challenges))
                                            @foreach($challenges as $challenge)
                                                <option value="{{ $challenge->challenge_name }}">{{ $challenge->challenge_name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">No data available</option>
                                        @endif

                                    </select>
                                    <button type="submit" class="btn mt-4 btn-primary">View</button>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

    </div>




    @if(isset($top5))
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3>Best performing schools</h3>
                        <h4>Challenge : {{$challengeName}}</h4>
                    </div>

                        <table class="table text-center align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    School name</th>


                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    District</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Average percentage score</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Average score</th>

                            </tr>
                            </thead>
                            <tbody>
                        @foreach($top5 as $school)
                            <tr>
                                <td>


                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$school['school_name']}}</h6>

                                        </div>

                                </td>

                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{$school['district']}}</h6>

                                    </div>                                    <!--<p class="text-xs text-secondary mb-0">Organization</p>-->
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">{{$school['average_percentage_score']}}%</span>

                                    </div>
                                </td>

                                <td class="align-middle text-center">
                                    <span class="badge badge-sm bg-gradient-success">{{$school['average_score']}}</span>
                                </td>

                            </tr>

                        @endforeach
                            </tbody>
                        </table>




                </div>
            </div>
        </div>
        @endif


        @if(isset($bottom5))
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
<<<<<<< HEAD
                        <h6>Table for Best Performing Schools</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            School name </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           School District</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            School RegNo</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Total score</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($bestPerformingSchools as $school)
                                  <tr>
                                 <td>{{ $school->school_name }}</td>
                                <td>{{ $school->school_regNo }}</td>
                                <td>{{ $school->school_district }}</td>
                                <td>{{ $school->total_score }}</td>
                                </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <!--<div>
                                                    <img src="/mathematicsimages/mathematicsimages/New Stevenson Primary.jpeg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="school badge">
                                                </div>-->
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">New Stevenson Primary School</h6>
                                                    <p class="text-xs text-secondary mb-0">"Excel With God's Help"</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Kampala</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">40</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">100%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 100%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <!--<div>
                                                    <img src="/mathematicsimages/mathematicsimages/Oak international School.png"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="school badge">
                                                </div>-->
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Oak International School</h6>
                                                    <p class="text-xs text-secondary mb-0">"We strive to achieve"</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Wakiso</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">40</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">100%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 100%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <!--<div>
                                                    <img src="/mathematicsimages/mathematicsimages/Kampala Junior School.jpg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="school badge">
                                                </div>-->
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Kampala Junior School</h6>
                                                    <p class="text-xs text-secondary mb-0">"For Future Leaders"</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Kampala</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">30</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">90%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                            aria-valuenow="90" aria-valuemin="0" aria-valuemax="90"
                                                            style="width: 90%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <!--<div>
                                                    <img src="/mathematicsimages/mathematicsimages/TNGS.png"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="school badge">
                                                </div>-->
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">The North Green School</h6>
                                                    <p class="text-xs text-secondary mb-0">"Excellence and Achievementg"</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Mbarara</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">30</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">95%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                                            aria-valuenow="95" aria-valuemin="0" aria-valuemax="95"
                                                            style="width: 95%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <!--<div>
                                                    <img src="/mathematicsimages/Bulamu Primary School.png"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="school badge">
                                                </div>-->
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Bulamu Primary School</h6>
                                                    <p class="text-xs text-secondary mb-0">"A New Lease Of Life"</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Jinja</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">10</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">80%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info" role="progressbar"
                                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="80"
                                                            style="width: 80%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <!--<div>
                                                    <img src="/mathematicsimages/mathematicsimages/kennedy Primary School.png"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="school badge">
                                                </div>-->
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">Kennedy Primary School</h6>
                                                    <p class="text-xs text-secondary mb-0">"Education Is Our Priotity"</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Masaka</p>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">25</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">100%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 100%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
=======
                        <h3>Worst performing schools</h3>
                        <h4>Challenge : {{$challengeName}}</h4>
>>>>>>> 552908c26abc96508bd6ffc57353b2826490491e
                    </div>

                        <table class="table text-center align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    School name</th>


                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    District</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Average percentage score</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Average score</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bottom5 as $school)
                                <tr>
                                    <td>


                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$school['school_name']}}</h6>

                                        </div>

                                    </td>

                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$school['district']}}</h6>

                                        </div>                                    <!--<p class="text-xs text-secondary mb-0">Organization</p>-->
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold">{{$school['average_percentage_score']}}%</span>

                                        </div>
                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-success">{{$school['average_score']}}</span>
                                    </td>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>




                </div>
            </div>
        </div>
        @endif
    @if(isset($top5_general))
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3>Best performing schools Overall</h3>

                    </div>

                    <table class="table text-center align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                School name</th>


                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                District</th>

                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Average percentage score</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($top5_general as $school)
                            <tr>
                                <td>


                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{$school['school_name']}}</h6>

                                    </div>

                                </td>

                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{$school['district']}}</h6>

                                    </div>                                    <!--<p class="text-xs text-secondary mb-0">Organization</p>-->
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">{{$school['average_percentage_score']}}%</span>

                                    </div>
                                </td>



                            </tr>

                        @endforeach
                        </tbody>
                    </table>




                </div>
            </div>
        </div>
    @endif


    @if(isset($bottom5_general))
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3>Worst performing schools Overall</h3>
                    </div>

                    <table class="table text-center align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                School name</th>


                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                District</th>

                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Average percentage score</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bottom5_general as $school)
                            <tr>
                                <td>


                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{$school['school_name']}}</h6>

                                    </div>

                                </td>

                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{$school['district']}}</h6>

                                    </div>                                    <!--<p class="text-xs text-secondary mb-0">Organization</p>-->
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="me-2 text-xs font-weight-bold">{{$school['average_percentage_score']}}%</span>

                                    </div>
                                </td>



                            </tr>

                        @endforeach
                        </tbody>
                    </table>




                </div>
            </div>
        </div>
    @endif


{{--        display options of the challenges--}}


    </body>
    <footer style="background-color: #f0f0f0; padding: 10px; text-align: center;">
    <p>&copy; Mathematics challenge Competition. Numbers Dont Lie.</p>
</footer>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
