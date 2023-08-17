<?php
// Task 1: Start a session to use session storage

session_start();
include 'databaseconnection.php';

// Task 2: Save the answers in an associative array
$answers = [
    'proper_noun' => $_POST['proper_noun'],
    'verb_1' => $_POST['verb_1'],
    'noun_1' => $_POST['noun_1'],
    'adjective_1' => $_POST['adjective_1'],
    'noun_2' => $_POST['noun_2'],
    'exclamation' => $_POST['exclamation'],
    'noun_3' => $_POST['noun_3'],
    'adjective_phrase_1' => $_POST['adjective_phrase_1'],
    'noun_4' => $_POST['noun_4'],
    'adjective_phrase_2' => $_POST['adjective_phrase_2']

];
$_SESSION['answers'] = $answers;
// Task 3: Store the answers in session storage
$stmt = $conn->prepare("SELECT id, story_template FROM stories WHERE used = 0 ORDER BY RAND() LIMIT 1");
$stmt->execute();

$storyRow = $stmt->fetch(PDO::FETCH_ASSOC);
$story = $storyRow['story_template'];

$updateStmt = $conn->prepare("UPDATE stories SET used = 1 WHERE id = :id");
$updateStmt->bindParam(':id', $storyRow['id']);
$updateStmt->execute();

foreach ($answers as $placeholder => $answer) {
    $story = str_replace("{" . $placeholder . "}", $answer, $story);
}


$_SESSION['generated_story'] = $story;
// Task 4: Redirect to the story generation page or other logic
header('Location: DisplayStoryPage.php');
exit;

?>