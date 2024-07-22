@extends('layouts.app',['class' => 'g-sidenav-show bg-gray-100'])


  @include('layouts.navbars.auth.topnav', ['title' => 'Challenge Creation'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge List</title>
     <style>

        table {
            margin-left:280px;
            border-collapse: collapse; 
            width: 80%; 
        }
        
        th, td {
            border: 1px solid black; /
            padding: 10px; 
            text-align: 
        }
        
        th {
            background-color: #f0f0f0; 
        }
    </style>
    
</head>
<body style="text-align:center;" >
    <h1>Challenges</h1>

    <!-- Display success message if any -->
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo session('success'); ?>
        </div>
    <?php endif; ?>

    <!-- Add a link to create a new challenge -->
    <a href="<?php echo route('challenges.create'); ?>">Create New Challenge</a>

    <!-- Check if there are any challenges -->
    <?php if($allChallenges->count() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>description</th>
                    <th>Start Date</th>
                    <th>End date</th>
                    <th>Wrong Answer</th>
                    <th>Blank Answer</th>
                    <th>Questions to answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($allChallenges as $challenge): ?>
                    <tr>
                        <td><?php echo $challenge->challenge_name; ?></td>
                        <td><?php echo $challenge->challenge_description; ?></td>
                        <td><?php echo $challenge->challenge_start_date; ?></td>
                        <td><?php echo $challenge->challenge_end_date; ?></td>
                        <td><?php echo $challenge->wrong_answer_marks;?></td>
                        <td><?php echo  $challenge->blank_answer_marks;?></td>
                        <td><?php echo $challenge->questions_to_answer;?></td>
    
                        <td>
                            
                            <!-- Add a delete form here if needed -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No challenges found.</p>
    <?php endif; ?>

    
</body>
<footer style="background-color: #f0f0f0; padding: 10px; text-align: center;">
    <p>&copy;Mathematics challenge Competition. Numbers Dont Lie</p>
</footer>
</html>