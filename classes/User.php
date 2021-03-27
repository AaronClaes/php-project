<?php
include_once(__DIR__ . "/Db.php");

class User
{
    private $username;
    private $firstname;
    private $lastname;
    private $password;
    private $email;
    private $picture;
    private $description;

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        //CHECK IF EMPTY
        if (empty($username)) {
            throw new Exception("username may not be empty!");
        }
        //CHECK IF USERNAME IS AVAILABLE
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from users where username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetch();
        if ($result != false) {
            throw new Exception("username is already being used, please try a different one");
        }
        $this->username = $username;

        return $this;
    }



    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
