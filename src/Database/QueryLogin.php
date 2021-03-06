<?php

namespace Vinter\Database;

/**
 * Class for handling queries for database
 */
class QueryLogin
{
    private $db;

    /**
     * Set database object to use
     */
    public function setDatabaseObj($db)
    {
        $this->db = $db;
    }

    /**
     * Add user to database
     * @param $userName string The name of the user
     * @param $userPass string The user's password
     * @return void
     */
    public function addUser($userName, $userPass)
    {
        $sql = "INSERT INTO users (name, password) VALUES (?, ?)";
        $params = [$userName, $userPass];
        $this->db->execute($sql, $params);
    }

    /**
     * Check if user exists in database
     * @param $userName string The user to search for
     * @return bool True if user exists, otherwise false
     */
    public function userExists($userName)
    {
        $sql = "SELECT * FROM admin WHERE name = ?";
        $params = [$userName];
        $res = $this->db->executeFetchAll($sql, $params);
        if (!$res) {
            $sql = "SELECT * FROM users WHERE name = ?";
            $params = [$userName];
            $res = $this->db->executeFetchAll($sql, $params);
        }
        return $res;
    }

    /**
     * Get the hashed password from database
     * @param $user string The user to get password from/to
     * @return string The hashed password
     */
    public function getHashedPassword($userName)
    {
        $sql = "SELECT password FROM admin WHERE name = ?";
        $params = [$userName];
        $res = $this->db->executeFetch($sql, $params);
        if (!$res) {
            $sql = "SELECT password FROM users WHERE name = ?";
            $params = [$userName];
            $res = $this->db->executeFetch($sql, $params);
        }
        return $res->password;
    }

    /**
     * Change a users password
     * @param $userName string The name of the user
     * @param $password string The new password
     * @return void
     */
    public function changePassword($userName, $password)
    {
        $sql = "UPDATE users SET password = ? WHERE name = ?";
        $params = [$password, $userName];
        $this->db->execute($sql, $params);
    }

    /**
     * Get all from user
     * @param $userName string Name of the user
     * @return obj
     */
    public function getUser($userName)
    {
        $sql = "SELECT * FROM users WHERE name = ?";
        $params = [$userName];
        $res = $this->db->executeFetch($sql, $params);
        return $res;
    }

    /**
     * Update user information
     * @param $user string Name of the user
     * @param $present string New presentation
     * @param $favMovie string New favourite movie
     * @param $favColor string New favourite color
     * @return void
     */
    public function updateUser($user, $present, $favMovie, $favColor)
    {
        $sql = "UPDATE users SET presentation = ?, fav_movie = ?, "
            . "fav_color = ? WHERE name = ?";
        $params = [$present, $favMovie, $favColor, $user];
        $this->db->execute($sql, $params);
    }

    /**
     * Get all user rows
     * @return obj
     */
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $res = $this->db->executeFetchAll($sql);
        return $res;
    }

    /**
     * Remove user from database
     * @param $userName string Name of the user to remove
     * @return void
     */
    public function removeUser($userName)
    {
        $sql = "DELETE FROM users WHERE name = ?";
        $params = [$userName];
        $this->db->execute($sql, $params);
    }

    /**
     * Fetch users based on search string
     * @param $search string Base search on this
     * @return obj
     */
    public function searchUsers($search)
    {
        $sql = "SELECT * FROM users WHERE name LIKE ? ORDER BY name";
        $searchText = "%{$search}%";
        $params = [$searchText];
        $res = $this->db->executeFetchAll($sql, $params);
        return $res;
    }

    /**
     * Get number of users
     * @param $search string Optional limiter of result
     * @return int
     */
    public function getCount($search = null)
    {
        $sql = "SELECT COUNT(id) AS max FROM users WHERE name LIKE ?";
        $searchText = "%{$search}%";
        $params = [$searchText];
        $res = $this->db->executeFetch($sql, $params);
        return $res;
    }
}
