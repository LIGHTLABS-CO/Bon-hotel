<?php
// Path to store reviews
$file = 'reviews.json';

// Read existing reviews
$reviews = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Get POST data
$name = trim($_POST['name']);
$rating = intval($_POST['rating']);
$review = trim($_POST['review']);
$timestamp = date("Y-m-d H:i:s");

// Basic validation
if ($name === '' || $rating < 1 || $rating > 5 || $review === '') {
  echo "Invalid input. Please fill all fields correctly.";
  exit;
}

// Replace review if same name already exists
$found = false;
foreach ($reviews as &$entry) {
  if (strtolower($entry['name']) === strtolower($name)) {
    $entry['rating'] = $rating;
    $entry['review'] = $review;
    $entry['time'] = $timestamp;
    $found = true;
    break;
  }
}
unset($entry);

if (!$found) {
  $reviews[] = [
    'name' => htmlspecialchars($name),
    'rating' => $rating,
    'review' => htmlspecialchars($review),
    'time' => $timestamp
  ];
}

// Save back to file
file_put_contents($file, json_encode($reviews, JSON_PRETTY_PRINT));

header("Location: index.html");
exit;
?>
