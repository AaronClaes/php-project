<?php
include_once(__DIR__ . "/Db.php");

class User
{
    private $user_ID;
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
    public function getUserID()
    {
        return $this->user_ID;
    }

    /**
     * Set the value of User_ID
     *
     * @return  self
     */
    public function setuserID($username, $user_ID)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT ID FROM users WHERE username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetch();
        if ($result != false) {
            throw new Exception("Email is already being used, please try a different one");
        }
        $this->user_ID = $user_ID;

        return $this;
    }

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
        if ($action === "signup") {
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where username = :username");
            $statement->bindValue(":username", $username);
            $statement->execute();
            $result = $statement->fetch();
            if ($result != false) {
                throw new Exception("Username is already being used, please try a different one");
            }
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
    public function setPassword($password, $action)
    {
        if (empty($password)) {
            throw new Exception("Password may not be empty!");
        }

        if ($action === "signup") {
            $options = [
                'cost' => 14,
            ];
            $this->password = password_hash($password, PASSWORD_DEFAULT, $options);
        } else {
            $this->password = $password;
        }
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

        $sql = "SELECT username, password FROM users WHERE username = :username";
        $statement = $conn->prepare($sql);

        $username = $this->getUsername();
        $password = $this->getPassword();

        $statement->bindValue(":username", $username);
        $statement->execute();
        $result = $statement->fetchAll();
        $hash = $result[0]['password'];

        if (!password_verify($password, $hash)) {
            throw new Exception("Username or password is incorrect!");
        }
    }
}
