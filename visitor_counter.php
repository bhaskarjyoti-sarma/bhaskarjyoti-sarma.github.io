<?php
// Connect to your database
$dbHost = 'your_db_host';
$dbName = 'your_db_name';
$dbUsername = 'your_db_username';
$dbPassword = 'your_db_password';

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch current count from the database
$stmt = $db->prepare("SELECT count FROM visitor_count WHERE id = 1");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$visitorCount = $row['count'];

// Increment count by 1 and update in the database
$visitorCount++;
$stmt = $db->prepare("UPDATE visitor_count SET count = :count WHERE id = 1");
$stmt->bindParam(':count', $visitorCount);
$stmt->execute();

// Output the visitor count
echo $visitorCount;
?>
