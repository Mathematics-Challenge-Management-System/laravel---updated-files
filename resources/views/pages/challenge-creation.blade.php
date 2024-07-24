@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])


@include('layouts.navbars.auth.topnav', ['title' => 'Challenge Creation'])
<div style="text-align:center;">

    <!-- Challenge Creation Section -->
    <div class="create-challenge">
        <h2>Create a New Challenge</h2>
        <form method="POST" action="{{ route('challenges.store') }}" style="width: 60%; margin: 0 auto; padding: 20px; border: 1px solid #ddd; box-shadow: 0px 2px 5px rgba(0,0,0,0.1);"enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="admin_id" value="{{ Auth::id() }}">
            <div class="form-group">
                <label for="name">Challenge Name:</label>
                <input type="text" id="name" name="challenge_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="number">Challenge Description:</label>
                <textarea id="description" name="challenge_description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="challenge_start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="finish_date">Finish Date:</label>
                <input type="date" id="finish_date" name="challenge_end_date" class="form-control" required>
            </div>
             <div class="form-group">
                 <label for="mark_for_answer">Duration of attempt:</label>
                <input type="number" id="duration" name="duration" class="form-control  " required>
            </div>

            <div class="form-group">
                <label for="wrong_answer_marks">Wrong Answer Marks:</label>
                <p>Should either be negative or zero</p>
                <input type="number" id="wrong_answer_marks" name="wrong_answer_marks" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="blank_answer_marks">Blank Answer Marks:</label>
                <input type="number" id="blank_answer_marks" name="blank_answer_marks" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="questions_to_answer">Questions to Answer:</label>
                <input type="number" id="questions_to_answer" name="questions_to_answer" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="">Question Document (Excel)</label>
                <input type="file" id="questionDocument" name="question_document" required  accept=".xlsx, .xls">
            </div>
            <div class="form-group">
                <label for="answerDocument">Answer Document (Excel)</label>
                <input type="file" id="answerDocument" name="answer_document" required  accept=".xlsx, .xls">
            </div>
             <button type="submit" class="btn btn-primary">Create Challenge</button>


        </form>

        <footer style="background-color: #f0f0f0; padding: 10px; text-align: center;">
    <p>&copy; Mathematics challenge Competition. Numbers Dont Lie</p>
</footer>

</div>
</div>

