<?php
class Post
{
    private $userId;
    private $description;
    private $image;
    private $tags;
    private $created;
    private $inappropriate;

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
        $this->description = $description;

        return $this;
    }

    public function saveImage($image)
    {
        $target_dir = "uploads/posts/";
        $file = $image;
        $path = pathinfo($file);
        $id = $this->getUserId();
        $ext = $path['extension'];
        $temp_name = $_FILES['image']['tmp_name'];
        $filename = "post_" . $id . "_" . mt_rand(100000, 999999);
        $path_filename_ext = $target_dir . $filename . "." . $ext;

        while (file_exists($path_filename_ext)) {
            $filename = "post_" . $id . "_" . mt_rand(100000, 999999);
            $path_filename_ext = $target_dir . $filename . "." . $ext;
        }
        move_uploaded_file($temp_name, $path_filename_ext);
        if (!$path_filename_ext) {
            throw new Exception("Something went wrong when uploading the image, please try again later");
        }
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
}
