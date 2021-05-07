<?php
include_once(__DIR__ . "/Db.php");
class Comment
{
    
    private $text;
    private $date;
    private $postId;
    private $userId;


    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

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

    public function saveComment(){
        $conn = Db::getConnection();
        $sql = "INSERT INTO comments (text, post.id, user_id, created) SELECT post.id FROM posts JOIN comments ON posts.id = comments.post_id values (:text, :post_Id, :user_Id, :created)";
        $statement = $conn->prepare($sql);
        $text = $this->getText();
        $postId = $this->getPostId();
        $userId = $this->getUserId();
        $date = $this->getDate();

        $statement->bindValue(":text", $text );
        $statement->bindValue(":postId", $postId);
        $statement->bindValue(":userId", $userId);
        $statement->bindValue(":created", $date);

        $result = $statement->execute();
        return $result;
    }
    /*public static function getAllComments(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM comments WHERE post_Id = :postId");
       
        $statement->bindValue(':postId', $postId);
        
        $result = $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }*/

}
