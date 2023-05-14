<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Обробка GET-запиту
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $searchQuery = $_GET['search'];

        // Зібрати URL для запиту до Google API Custom Search
        $apiKey = 'AIzaSyDCnbyX-ZlT95B-rmvB8Bpb3wTcGQGviz0'; // Замініть на свій API ключ
        $cx = 'e08bbbdd1d17c49c9'; // Замініть на свій CX код
        $url = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$cx}&q={$searchQuery}";

        // Виконання запиту за допомогою cURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        // Декодування відповіді JSON у масив
        $data = json_decode($response, true);

        // Відображення отриманих даних
        var_dump($data); // Використовуйте var_dump для перевірки

        // Збереження значень "items" у окрему змінну
        $items = $data['items'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>My Browser</h2>
<form method="GET" action="/index.php">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" value=""><br><br>
    <input type="submit" value="Submit">
</form>

<?php


if (isset($items)) {
    foreach ($items as $item) {
        echo "<h3>{$item['title']}</h3>";
        echo "<p>{$item['snippet']}</p>";
        echo "<a href=\"{$item['link']}\">{$item['link']}</a>";
        echo "<hr>";
    }
}
?>

</body>
</html>
