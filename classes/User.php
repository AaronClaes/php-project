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
    public function setUsername($username, $action)
    {
        //CHECK IF EMPTY
        if (empty($username)) {
            throw new Exception("Username may not be empty!");
        }
        //CHECK IF USERNAME IS AVAILABLE
        if($action === "signup"){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where username = :username");
            $statement->bindValue(":username", $username);
            $statement->execute();
            $result = $statement->fetch();
            if ($result != false) {
                throw new Exception("Username is already being used, please try a different one");
            }
            $this->username = $username;
        }
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
        if (empty($firstname)) {
            throw new Exception("First name may not be empty!");
        }
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
        if (empty($lastname)) {
            throw new Exception("Last name may not be empty!");
        }
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
        if (empty($password)) {
            throw new Exception("Password may not be empty!");
        }
        $options = [
            'cost' => 14,
        ];
        $this->password = password_hash($password, PASSWORD_DEFAULT, $options);


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
        if (empty($email)) {
            throw new Exception("Email may not be empty!");
        }
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from users where email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();
        $result = $statement->fetch();
        if ($result != false) {
            throw new Exception("Email is already being used, please try a different one");
        }
        $this->email = $email;

        return $this;
    }

    public function save()
    {
        $conn = Db::getConnection();

        $sql = "INSERT INTO users (email, firstname, lastname, username, password) VALUES (:email, :firstname, :lastname, :username, :password)";
        $statement = $conn->prepare($sql);
        $email = $this->getEmail();
        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $username = $this->getUsername();
        $password = $this->getPassword();
        

        $statement->bindValue(":email", $email);
        $statement->bindValue(":firstname", $firstname);
        $statement->bindValue(":lastname", $lastname);
        $statement->bindValue(":username", $username);
        $statement->bindValue(":password", $password);
        $result = $statement->execute();
    }

    public function login()
    {
        $conn = Db::getConnection();
        
        $sql = "SELECT username, password FROM users WHERE username = :username AND password = :password ";
        $statement = $conn->prepare($sql);
        
        $username = $this->getUsername();
        $password = $this->getPassword();

        $statement->bindValue(":username", $username);
        $statement->bindValue(":password", $password);
        $result = $statement->execute();
        var_dump($result);

        if ($result != true) {
            throw new Exception("Username or password is incorrect!");
        }
    }

}