<?php

session_start();

$story = $_SESSION['generated_story'] ?? "Sorry, no story was generated!";

echo "<h2>Your Funny Story</h2>";
echo "<p>$story</p>";

?>
