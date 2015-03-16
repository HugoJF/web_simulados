<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Web_simulados_model
 */
class Web_simulados_model extends CI_Model
{
    /**
     * Search for questions inside a category
     *
     * @param int $categoryId - the category ID for the questions
     * @param int $limit - query entry limit
     * @param int $offset - query entry offset
     * @return object - FALSE if query is empty, CI_DB_mysql_result if successful
     */
    public function get_questions_by_category($categoryId = -1, $limit = 10, $offset = 0)
    {
        if ($categoryId === -1 || !is_numeric($categoryId)) {
            return false;
        }

        $sql = 'SELECT * FROM questions_category LEFT JOIN questions ON questions_category.question = questions.id WHERE questions_category.category=?';
        return $this->db->query($sql, array($categoryId));
    }

    /**
     * Get categories that are 1 level sub-category from supplied category
     *
     * @param $category - the category to search sub-categories
     * @return object - FALSE if query is empty, CI_DB_mysql_result if successful
     */
    public function get_direct_sub_categories_from($category)
    {
        if ($category === -1 || !is_numeric($category)) {
            return false;
        }

        $sql = 'SELECT * FROM category WHERE sub_category_from = ?';
        return $this->db->query($sql, array($category));
    }

    /**
     * Get every sub-category from supplied category
     *
     * @param $category - the category to search sub-categories
     * @return array - contains (int) ids for categories
     */
    public function get_all_sub_categories_from($category)
    {
        $total = array();
        $partial = array();

        array_push($partial, $category);

        while (sizeof($partial) != 0) {
            foreach ($partial as $key => $part) {
                $query = $this->get_direct_sub_categories_from($part);
                foreach ($query->result() as $val) {
                    array_push($partial, $val->id);
                }
                array_push($total, $part);
                unset($partial[$key]);
            }
        }
        return $total;
    }

    /**
     * Returns full question by id
     *
     * @param int $id - the question id
     * @return object - FALSE if query is empty, CI_DB_mysql_result if successful
     */
    public function get_question_by_id($id = -1)
    {
        if ($id === -1 || !is_numeric($id)) {
            return false;
        }

        $sql = 'SELECT * FROM questions WHERE questions.id=?';
        return $this->db->query($sql, array($id));
    }

    /**
     * Return what category the question is classified
     *
     * @param int $question_id - the question id
     * @return object - FALSE if query is empty, CI_DB_mysql_result if successful
     */
    public function get_category_from_question($question_id = -1)
    {
        if ($question_id === -1 || !is_numeric($question_id)) {
            return false;
        }

        $sql = 'SELECT * FROM questions_category LEFT JOIN category ON category.id=questions_category.category WHERE questions_category.question = ?';
        return $this->db->query($sql, array($question_id));
    }

    /**
     * Return entire level 0 category database
     *
     * @return object - FALSE if query is empty, CI_DB_mysql_result if successful
     */
    public function get_categories()
    {
        $sql = 'SELECT * FROM category WHERE sub_category_from IS NULL';
        return $this->db->query($sql);
    }

    /**
     * Returns one level sub-categories from supplied category
     *
     * @param $from - the category to search it's sub-categories
     * @return object - FALSE if query is empty, CI_DB_mysql_result if successful
     */
    public function get_sub_categories($from)
    {
        $sql = 'SELECT * FROM category WHERE sub_category_from ?';
        return $this->db->query($sql, array($from));
    }

    /**
     * Returns entire category database
     *
     * @return object - FALSE if query is empty, CI_DB_mysql_result if successful
     */
    public function get_all_categories()
    {
        $sql = 'SELECT * FROM category';
        return $this->db->query($sql);
    }

    /**
     * Returns string with supplied category name
     *
     * @param $id - the category id
     * @return string
     */
    public function get_category_name($id)
    {
        $sql = 'SELECT category_name FROM category WHERE id = ? ';
        return $this->db->query($sql, array($id))->result()[0]->category_name;
    }
}