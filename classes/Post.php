<?php

include_once(__DIR__ . "/Db.php");

class Post
{
    private $postId;
    private $userId;
    private $description;
    private $image;
    private $tags;
    private $created;
    private $inappropriate;
    private $location;


    /**
     * Get the value of postId
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId
     *
     * @return  self
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        //CHECK IF EMPTY
        if (empty($description)) {
            throw new Exception("Description may not be empty!");
        }

        $this->description = $description;

        return $this;
    }

    public function saveImage($image, $type)
    {
        //CHECK IF EMPTY
        if (empty($_FILES["image"]["name"])) {
            throw new Exception("An image upload is required!");
        }

        $target_dir = "uploads/posts/";
        $file = $image;
        $path = pathinfo($file);
        $id = $this->getUserId();
        $ext = $path['extension'];
        $temp_name = $_FILES['image']['tmp_name'];

        //APPLY FILTER
        if ($ext === "png") {


            $img = imagecreatefrompng($temp_name);
            switch ($type) {
                case 'IMG_FILTER_NEGATE':
                    imagefilter($img, IMG_FILTER_NEGATE);
                    break;
                case 'IMG_FILTER_GRAYSCALE':
                    imagefilter($img, IMG_FILTER_GRAYSCALE);
                    break;
                case 'IMG_FILTER_COLORIZE':
                    imagefilter($img, IMG_FILTER_COLORIZE, 50, 0, 0);
                    break;
                case 'IMG_FILTER_MEAN_REMOVAL':
                    imagefilter($img, IMG_FILTER_MEAN_REMOVAL);
                    break;
                case 'IMG_FILTER_EMBOSS':
                    imagefilter($img, IMG_FILTER_EMBOSS);
                    break;
                default:
                    break;
            }
            imagepng($img, $temp_name);
        }
        //SET FILENAME
        $filename = "post_" . $id . "_" . mt_rand(100000, 999999);
        $path_filename_ext = $target_dir . $filename . "." . $ext;
        //CHECK IF FILENAME EXCISTS
        while (file_exists($path_filename_ext)) {
            $filename = "post_" . $id . "_" . mt_rand(100000, 999999);
            $path_filename_ext = $target_dir . $filename . "." . $ext;
        }
        //MOVE TO FOLDER
        move_uploaded_file($temp_name, $path_filename_ext);
        if (!$path_filename_ext) {
            throw new Exception("Something went wrong when uploading the image, please try again later");
        }
        return $path_filename_ext;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function cleanupTags($tags)
    {
        $tags = strtolower($tags);
        $tags = str_replace(' ', '', $tags);
        return $tags;
    }

    /**
     * Get the value of tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the value of tags
     *
     * @return  self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get the value of created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the value of created
     *
     * @return  self
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of inappropriate
     */
    public function getInappropriate()
    {
        return $this->inappropriate;
    }

    /**
     * Set the value of inappropriate
     *
     * @return  self
     */
    public function setInappropriate($inappropriate)
    {
        $this->inappropriate = $inappropriate;

        return $this;
    }

    /**
     * Get the value of Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of Location
     *
     * @return  self
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public function save()
    {
        $conn = Db::getConnection();

        $sql = "INSERT INTO posts (user_id, image, description, created, tags, location) VALUES (:user_id, :image, :description, UTC_TIMESTAMP(), :tags, :location)";
        $statement = $conn->prepare($sql);
        $user_id = $this->getUserId();
        $image = $this->getImage();
        $description = $this->getDescription();
        $tags = $this->getTags();
        $location = $this->getLocation();

        $statement->bindValue(":user_id", $user_id);
        $statement->bindValue(":image", $image);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":tags", $tags);
        $statement->bindValue(":location", $location);
        $statement->execute();
    }

    public function flag()
    {
        $conn = Db::getConnection();

        $sql = "UPDATE posts SET inappropriate = 1 WHERE id = :id";
        $statement = $conn->prepare($sql);

        $id = $this->getPostId();
        $statement->bindValue(":id", $id);
        $statement->execute();

        return $this;
    }

    public function delete()
    {
        $conn = Db::getConnection();

        $sql = "DELETE FROM posts WHERE id = :id";
        $statement = $conn->prepare($sql);

        $id = $this->getPostId();
        $statement->bindValue(":id", $id);
        $statement->execute();

        return $this;
    }

    public static function getFeedPosts()
    {
        $conn = Db::getConnection();

        $sql = "SELECT *, posts.id as postId FROM posts JOIN users ON users.id=posts.user_id WHERE  user_id != :user_id AND inappropriate = 0";
        $statement = $conn->prepare($sql);
        $user_id = $_SESSION["userId"];

        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $posts = $statement->fetchAll();
        return $posts;
    }

    public static function getUserPosts($user_id)
    {
        $conn = Db::getConnection();

        $sql = "SELECT *, posts.id as postId FROM posts JOIN users ON users.id=posts.user_id WHERE  user_id = :user_id AND inappropriate = 0 ORDER BY created DESC; ";
        $statement = $conn->prepare($sql);


        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $posts = $statement->fetchAll();
        return $posts;
    }

    public static function getPostsByTag($tag)
    {
        $conn = Db::getConnection();

        $sql = "SELECT *, posts.id as postId FROM posts JOIN users ON users.id=posts.user_id WHERE INSTR(tags, :tag) > 0 AND inappropriate = 0 ORDER BY created DESC; ";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":tag", $tag);
        $statement->execute();
        $posts = $statement->fetchAll();
        return $posts;
    }

    //source: https://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
    public static function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago); //php function to get datetime difference

        $diff->w = floor($diff->d / 7); //round off week number
        $diff->d -= $diff->w * 7; //amount of days ago

        $string = array( //display text
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) { //check if y,m,w,d,h,i,s is not null in $diff
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : ''); //set value of string to correct time
            } else {
                unset($string[$k]); //unset if y,m,w,d,h,i,s is null in $diff
            }
        }
        if (!$full) $string = array_slice($string, 0, 1); //get first time unit
        return $string ? implode(', ', $string) : 'just now'; //if no string -> return "just now"
    }
}
