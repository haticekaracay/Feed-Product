<?php

$connect = new PDO("mysql:host=localhost;dbname=products", "root", "");

$query = "SELECT * FROM product ORDER BY id ASC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

header("Content-Type: text/xml;charset=iso-8859-1");

$base_url = "http://localhost/feed/";

echo "<?xml version='1.0' encoding='UTF-8' ?>" . PHP_EOL;
echo "<rss version='2.0'>".PHP_EOL;
echo "<channel>".PHP_EOL;
//echo "<title>Product Feed</title>".PHP_EOL;
//echo "<link>".$base_url."index.php</link>".PHP_EOL;
//echo "<description>Product Feeder</description>".PHP_EOL;
//echo "<language>tr</language>".PHP_EOL;

foreach($result as $row)
{
    $queryCat = $connect ->prepare("SELECT * FROM category WHERE id= ? ");
    $queryCat->execute([$row['categoryId']]);
    $result = $queryCat->fetch();
    $categoryName = $result["name"];
 
    echo "<item xmlns:dc='ns:1'>".PHP_EOL;
    echo "<title>".$row["name"]."</title>".PHP_EOL;
    echo "<guid>".md5($row["id"])."</guid>".PHP_EOL;
    echo "<category>$categoryName</category>".PHP_EOL;
    echo "<title>".$row["price"]."</title>".PHP_EOL;
    echo "</item>".PHP_EOL;
}

echo '</channel>'.PHP_EOL;
echo '</rss>'.PHP_EOL;

?>