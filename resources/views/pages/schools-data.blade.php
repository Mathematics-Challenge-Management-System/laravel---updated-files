@extends('layouts.app')
@include('layouts.navbars.auth.topnav', ['title' => 'Challenge Creation'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Information</title>
     
</head>
    <h1>school-data</h1>
    
        <thead>
            <tr>
                <th>School Name</th>
                <th>School District</th>
                <th>School RegNo</th>
                <th>Representative Firstname</th>
                <th>Representative Lastname</th>
                <th>Representative Email</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($school_representative as $index => $school)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td> {{ $school->school_name }}</td>
                    <td>{{ $school->school_district }}</td>
                    <td>{{ $school->school_regNo }}</td>
                    <td>{{ $school->representative_firstname }}</td>
                    <td>{{ $school->representative_lastname }}</td>
                    <td>{{ $school->representative_email }}</td>
                </tr>
            
                @empty
                <tr>
                    <td colspan="6" class="text-center">No schools found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

   
</div>

<!--@extends('layouts.app')
@include('layouts.navbars.auth.topnav', ['title' => 'Your school'])
@section('content')
<h1>School Information</h1>
<table>
    <tr>
        <th colspan="2">School Information</th>
    </tr>
                            <!--<table class="table align-items-center mb-0">-->
                                <thead>
                                    <tr>
                                        <th>School_name</th> 
                                        <th>District</th>  
                                        <th>Reg_no</th>
                                        <th>school_phone</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($school_representative->isEmpty())
                                    <p>No shools found</p>
                                    @else
                                    @foreach($school_representative as $school)
                                    <tr>
                                        <td>{{$school->school_name}}</td>
                                        <td>{{$school->school_regNo}}</td>
                                        <td>{{$school->school_district}}</td>
                                        <td>{{$school->school_phone}}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        </tbody>
                                        </table>
                                        @endsection



                                            