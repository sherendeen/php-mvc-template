<?php namespace app; ?>
<!doctype html>
<html lang="en">
<head>
<title>Blog MVC Site</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="resources/css/style_n14.css">
</head>
<?php
use app\Controllers\SocialController;
use app\Views\AboutView;
use app\Models\Post\Post;
use app\Views\PostView;
// bootstrap code
include 'app\Models\Post\Post.php';
include 'app\Controllers\SocialController.php';
include 'app\Views\PostView.php';
const QUERY_GET_LAST_10_POSTS = "SELECT * FROM posts_table ORDER BY id DESC LIMIT 10;";
use PDO;
use PDOException;
Use Exception;


ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(E_ALL);

function dbGetLastTenPost(PDO $db) : array 
{
    $posts = array();
    try 
    {
		$statement = $db->prepare(QUERY_GET_LAST_10_POSTS);
        $statement->execute();
        while($elements = $statement->fetch(PDO::FETCH_ASSOC)) 
        {
            $posts[$elements['id']] = array(
                'id' => $elements['id'],
                'filename' => $elements['filename'],
                'description' => $elements['description'],
                'dateCreated' => $elements['timeposted'],
                'ipaddress' => $elements['ipaddress_used'],
                'is_nsfw' => $elements['is_nsfw'],
                'author' => $elements['author'],
                'is_hidden' => $elements['is_hidden']
            );
        }

		return $posts;
    }
    catch (PDOException $e) 
    {
        echo ('<p>Exception:' . $e->getMessage()
            . ' [dbGetLastTenPosts()]</p>');
    }
    catch (Exception $e)
    {
        echo ('<p>Exception:' . $e->getMessage()
            . ' [dbGetLastTenPosts()]</p>');
    }
    return $posts;
}

function dbConnect(string $dsn = '', string $dbUsername = '', string $dbPassword = ''): PDO
{
    if (empty($dsn) || empty($dbUsername) || empty($dbPassword))
    {
        $iniFile = parse_ini_file('connection.ini');
        $dsn = $iniFile['dsn'];
        $dbUsername = $iniFile['username'];
        $dbPassword = $iniFile['password'];
    }
    
    try
    {
        $db = new PDO($dsn, $dbUsername, $dbPassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
		echo 'dsn: [' . $dsn . '], dbUsername: [' . $dbUsername . '], [' . $dbPassword . '] ';
		
        echo '###exception caught!! ' . $e->getMessage() . ' ' . $e->getFile();
    }
    catch (Exception $e)
    {
        echo '###exception caught!! ' . $e->getMessage() . ' ' . $e->getFile();
    }
    
    return $db;
    
    
}
$postModel = Post::class;
$postView = PostView::class;
$db = dbConnect();
$arrayOfMine = dbGetLastTenPost($db);

//echo '<div>' . var_dump($arrayOfMine). '</div>';
foreach ($arrayOfMine as $arr ){
	$post = new Post($arr);
	$postsController = new SocialController();
	$postsController->postModel = $post;
	$postsController->postView = PostView::class;
	$postsController->showPost($post);
}


?>