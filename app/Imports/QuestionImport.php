<?php
namespace App\Imports;

use App\Models\Question;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;

class QuestionImport implements ToCollection, WithHeadingRow
{
protected $answers;
protected $challenge_id;

public function __construct($questionFilePath, $answersFilePath,$challenge_id)
{
$this->challenge_id = $challenge_id;
// Read and store answers from the provided file
$this->answers = Excel::toArray(null, $answersFilePath)[0];
// Import questions
Excel::import($this, $questionFilePath);
}

public function collection(Collection $rows)
{
foreach ($rows as $index => $row) {
$answerData = $this->answers[$index] ?? null; // Match by index


if ($answerData) {
Question::create([
'question' => $row['question'],
'answer' => $answerData[0], // Assuming answer is in the second column
'marks' => $answerData[1], // Assuming marks are in the third column
// Include 'challenge_id' if required, ensure it's passed or available
'challenge_id' => $this->challenge_id,
]);
}
}
}
}
