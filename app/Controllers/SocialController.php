<?php
namespace app\Controllers;
use app\Views\Shared\ErrorView;
use app\Views\PostView;
use app\Views\Shared\LayoutView;
require 'app\Views\Shared\LayoutView.php';

const QUERY_GET_10_POSTS_BY_ID = "SELECT * FROM posts_table WHERE id = :displayname ORDER BY timeposted DESC LIMIT 1;";

use Exception;
use PDO;
use PDOException;

// controller
class SocialController {
    public $postModel;
    public $postView;
    
    public function __construct($params = array()) {
        foreach($params as $key => $value) {
            $this->{$key} = $value;
        }
    }

    
    public function showPost($post) {
        
        
        if ($post == null) {
            $errorView = new ErrorView();
            $errorView->showError('Post not found');
            return;
        }
        $postView = new PostView();
        $layoutView = new LayoutView();
        $content = $postView->getPostDisplay($post);
        $layoutView->render($content);
    }
}

?>