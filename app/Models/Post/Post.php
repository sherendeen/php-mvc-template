<?php
namespace app\Models\Post;

//require 'app\Models\Post\Post.php';

class Post {
    public $id;
    public $dateCreated;
    public $author;
    public $is_hidden;
    public $filename;
    public $description; 
    public $is_nsfw;
    public $ipaddress;

    public function __construct($params = array()) {
        foreach($params as $key => $value) {
            $this->{$key} = $value;
        }
    }
}

?>