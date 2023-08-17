<?php

// Connect to the database using PDO
$dbname = 'library';
$host = 'mysql';
$username = 'webDev'; // Replace with your username
$password = 'webDev'; // Replace with your password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the "stories" table exists
    $result = $conn->query("SHOW TABLES LIKE 'stories'");
    
    if ($result->rowCount() == 0) {
        // Create the "stories" table
        $conn->exec("
            CREATE TABLE stories (
                id INT PRIMARY KEY AUTO_INCREMENT,
                story_template TEXT NOT NULL,
                used BOOLEAN DEFAULT 0
            )
        ");

        // Insert random stories
        $stories = [
            "One day, {proper_noun} decided to {verb_1} a {noun_1} while wearing a {adjective_1} {noun_2}. Suddenly, a {noun_3} appeared and yelled, '{exclamation}! That's my {noun_4}!' {proper_noun} shouted, '{adjective_phrase_1}!' and ran away with a {adjective_phrase_2} grin.",
            "In the magical land of {proper_noun}, there lived a {adjective_1} {noun_1} who loved to {verb_1} with a {noun_2}. Every morning, it would sing, '{exclamation}! It's time to {verb_1}!' Then it would dance with a {noun_3} wearing a {adjective_phrase_1} hat.",
            "When {proper_noun} went to the {noun_1}, a {adjective_1} {noun_2} jumped out and said, '{exclamation}! I've been waiting to {verb_1} with you!' They spent the day eating {noun_3} and riding a {adjective_phrase_1} {noun_4}. It was a {adjective_phrase_2} day!",
            "At the {noun_1} competition, {proper_noun} performed a {adjective_1} dance with a {noun_2}. The crowd went wild, shouting '{exclamation}! Look at that {noun_3}!' Even Grandma joined in, wearing a {adjective_phrase_1} costume and doing a {adjective_phrase_2} dance!",
            "In the town of {proper_noun}, there was a {noun_1} that could {verb_1}. People would come and say, '{exclamation}! That's a {adjective_1} {noun_2}!' One day, it even helped a {noun_3} win a {adjective_phrase_1} race. The town celebrated with {noun_4} pies!",
            "Once, {proper_noun} and a {noun_1} went on a {adjective_1} adventure. They {verb_1}ed through the {noun_2}, shouting '{exclamation}!' at every turn. They found Grandma doing a {adjective_phrase_1} dance with a {noun_3}. It was a {adjective_phrase_2} sight!",
            "During a {noun_1} race, {proper_noun} rode a {adjective_1} {noun_2}. As they crossed the finish line, the {noun_3} yelled, '{exclamation}! We won!' Everyone laughed, especially when they saw a {noun_4} doing a {adjective_phrase_1} dance with a {adjective_phrase_2}.",
            "At the {noun_1} party, {proper_noun} wore a {adjective_1} hat and danced with a {noun_2}. When asked why, {proper_noun} replied, '{exclamation}! It's my lucky {noun_3}!' Everyone joined in, even a {noun_4} wearing a {adjective_phrase_1} costume.",
            "In the {adjective_1} forest of {proper_noun}, a {noun_1} could {verb_1}. People would gather and shout, '{exclamation}! Look at that {noun_2}!' They even caught Grandma {verb_1}ing with a {noun_3}. It was a {adjective_phrase_1} wonder that brought joy to all.",
            "On a {adjective_1} day in {proper_noun}, a {noun_1} decided to {verb_1}. It met a {noun_2} that said, '{exclamation}! Let's be friends!' They danced and sang, and even found a {noun_3} wearing {noun_4} shoes. It was a {adjective_phrase_1} friendship."
        ];

        $stmt = $conn->prepare("INSERT INTO stories (story_template, used) VALUES (:story_template, 0)");
        foreach ($stories as $story) {
            $stmt->bindParam(':story_template', $story);
            $stmt->execute();
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;



#apparently this is all I need due to chatgpt:

// Connect to the database using PDO
$name = getenv('DB_NAME');
$host = getenv('DB_HOST');
$username = getenv('DB_USER'); 
$password = getenv('DB_PASSWORD'); 

try {
    $conn = new PDO("mysql:host=$host;dbname=$name;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

?>