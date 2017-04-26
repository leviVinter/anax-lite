<?php

namespace Vinter\Database;

/**
 * Class for handling queries to a content table
 */
class QueryContent
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
     * Get all rows from database
     * @param $type str Optional if you want to select certain types
     * @return obj
     */
    public function getAll($type = null)
    {
        $params = [];
        $sql = "SELECT *, CASE WHEN (deleted IS NOT NULL AND deleted <= NOW()) THEN "
            . "'isDeleted' WHEN (published IS NOT NULL AND published <= NOW()) THEN 'isPublished'"
            . "ELSE 'notPublished' END AS status FROM content";
        if ($type) {
            $sql .= " WHERE type = ?";
            $params = [$type];
        }
        $res = $this->db->executeFetchAll($sql, $params);
        return $res;
    }

    /**
     * Get content with specified id
     * @param $id int The id of the content to get
     * @return obj
     */
    public function getContent($id)
    {
        $sql = "SELECT * FROM content WHERE id = ?";
        $params = [$id];
        $res = $this->db->executeFetch($sql, $params);
        return $res;
    }

    /**
     * Get content with specified id
     * @param $path str The path of the content to get
     * @return obj
     */
    public function getPage($path)
    {
        $sql = "SELECT * FROM content WHERE path = ?"
            . " AND type = 'page'";
        $params = [$path];
        $res = $this->db->executeFetch($sql, $params);
        return $res;
    }

    /**
     * Get content with specified id
     * @param $slug int The slug of the content to get
     * @return obj
     */
    public function getBlog($slug)
    {
        $sql = "SELECT * FROM content WHERE slug = ?"
            . " AND type = 'post'";
        $params = [$slug];
        $res = $this->db->executeFetch($sql, $params);
        return $res;
    }

    /**
     * Check if slug combined with its path is unique
     * @param $id The id which should not be checked
     * @param $slug The slug to check
     * @param $path The path belonging to the slug
     * @return bool True if unique, otherwise false
     */
    public function slugIsUnique($id, $slug)
    {
        $sql = "SELECT id FROM content WHERE slug = ? "
            . "AND id <> ?";
        $params = [$slug, $id];
        $res = $this->db->executeFetchAll($sql, $params);
        return $res ? false : true;
    }

    /**
     * Update specified row
     * @param $params array All the values for the update
     * @return void
     */
    public function updateContent($params)
    {
        $sql = "UPDATE content SET title = ?, path = ?, slug = ?, "
            . "data = ?, type = ?, filter = ?, published = ?, "
            . "updated = NOW() WHERE id = ?";
        $params = [
            $params["title"],
            $params["path"],
            $params["slug"],
            $params["data"],
            $params["type"],
            $params["filter"],
            $params["published"],
            $params["id"]
        ];
        $this->db->execute($sql, $params);
    }

    /**
     * Insert new content and return new row
     * @param $title string The title for the new row
     * @return obj
     */
    public function insertContent($title)
    {
        $sql = "INSERT INTO content (title) VALUES (?)";
        $params = [$title];
        $this->db->execute($sql, $params);
        return $this->db->lastInsertId();
    }

    /**
     * Set deleted to current time for specified row
     * @param $id int The id of the row to update
     * @return void
     */
    public function deleteContent($id)
    {
        $sql = "UPDATE content SET deleted = NOW() "
            . "WHERE id = ?";
        $params = [$id];
        $this->db->execute($sql, $params);
    }
}
