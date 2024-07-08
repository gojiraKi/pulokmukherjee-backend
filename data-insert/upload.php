<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "12345678";
$database = "pulok_mukherjee_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read JSON data from file
$jsonData = file_get_contents('uploadData.json');

// Decode JSON data
$data = json_decode($jsonData, true);

$data = array_reverse($data);

// Iterate through the data and insert into the database
foreach ($data as $item) {
    $author = $conn->real_escape_string($item['author']);
    $title = $conn->real_escape_string($item['title']);
    // $article = $conn->real_escape_string($item['article']);
    // $article = $item['article'];
    $status = 10;
    date_default_timezone_set('Asia/Kolkata');
	$created_on = time();

    // $sql = "INSERT INTO book_contributed (title, article, status, created_on) VALUES ('$title', '$article', '$status', '$created_on')";
    $sql = "INSERT INTO book_contributed (author, title, status, created_on) VALUES (author, '$title', '$status', '$created_on')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully\n";
    } else {
        echo "Error inserting record: " . $conn->error . "\n";
    }
}

// Close connection
$conn->close();

// Reverse the order of data in 'contents'
// foreach ($papers as &$paper) {
//     $paper['contents'] = array_reverse($paper['contents']);
// }

// // Encode the modified data back to JSON
// $reversedJsonData = json_encode($papers, JSON_PRETTY_PRINT);

// // Print or save the reversed JSON data
// print_r($reversedJsonData);

// If you want to save the reversed JSON data to a file, uncomment the following line
// file_put_contents('reversed_data.json', $reversedJsonData);

?>
