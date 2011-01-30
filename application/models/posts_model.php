<?php
/**
 * Created by JetBrains PhpStorm.
 * User: seanmcgary
 * Date: 1/16/11
 * Time: 9:52 PM
 * To change this template use File | Settings | File Templates.
 */
require_once('base_model.php');
class Posts_Model extends Base_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('group_model');
    }

    public function insert($data)
    {
        $data['post_id'] = $this->generate_post_id();
        $data['date_posted'] = time();

        try
        {
            $this->posts_collection->insert($data, true);
        }
        catch(MongoCursorException $e)
        {
            echo "ERROR: ".$e;
            return false;
        }

        return true;

    }

    public function get_post_for_id($id)
    {
        $results = $this->posts_collection->find(array('post_id' => $id))->limit(1);

        if($results != NULL)
        {
            $post = array();
            foreach($results as $result)
            {
                $tmp = $result;
                $tmp['group'] = $this->group_model->get_group_for_id($tmp['group_id']);
                $post = $tmp;
            }

            return $post;
        }
        else
        {
            return false;
        }
    }

    public function get_flat_posts_by_date()
    {
        $results = $this->posts_collection->find(array('parent_id' => 'none'))->sort(array('date_posted' => -1));

        if($results != NULL)
        {
            $post = array();
            foreach($results as $result)
            {
                $tmp = $result;
                $tmp['group'] = $this->group_model->get_group_for_id($tmp['group_id']);
                $post[] = $tmp;
            }

            return $post;
        }
        else
        {
            return false;
        }
    }

    public function get_flat_posts_by_group_name($group_name)
    {
        $group_id = $this->group_model->get_group_for_name($group_name);
        $results = $this->posts_collection->find(array('parent_id' => 'none', 'group_id' => $group_id['group_id']))->sort(array('date_posted' => -1));

        if($results != NULL)
        {
            $post = array();
            foreach($results as $result)
            {
                $tmp = $result;
                $tmp['group'] = $this->group_model->get_group_for_id($tmp['group_id']);
                $post[] = $tmp;
            }

            return $post;
        }
        else
        {
            return false;
        }
    }

    /**
     * Get all of the top level posts. Top level posts have a parent_id of 'none'
     *
     * @return array
     */
    public function get_posts_threaded($parent_id = 'none', $parent_post = null)
    {
        $query = array('parent_id' => $parent_id);

        if($parent_post != null)
        {
            $query['post_id'] = $parent_post;
        }

        
        $results = $this->posts_collection->find($query)->sort(array('date_posted', -1));

        $top_posts = array();
        foreach($results as $res)
        {
            $tmp_post = $res;
            $tmp_post['group'] = $this->group_model->get_group_for_id($tmp_post['group_id']);
            // get the children
            $tmp_post['children'] = $this->get_child_thread($tmp_post['post_id']);

            $top_posts[] = $tmp_post;
        }

        return $top_posts;
    }

    /**
     * Get all child posts for a given post_id. Call function recursively to get children for the child.
     * If the search comes back null when looking for the child, simply return an empty array;
     * 
     * @param  $parent_id
     * @return array
     */
    public function get_child_thread($parent_id)
    {
        $results = $this->posts_collection->find(array('parent_id' => $parent_id))->sort(array('date_posted', -1));

        if($results != NULL)
        {
            $child_posts = array();
            foreach($results as $res)
            {
                $tmp_child = $res;
                $tmp_child['group'] = $this->group_model->get_group_for_id($tmp_child['group_id']);
                // get the children
                $tmp_child['children'] = $this->get_child_thread($res['post_id']);
                $child_posts[] = $tmp_child;

            }

            return $child_posts;
        }
        else
        {
            return array();
        }
    }






    public function get_posts_flat()
    {
        $results = $this->posts_collection->find();

        if($results != NULL)
        {
            $posts = array();
            foreach($results as $result)
            {
                $posts[] = $result;
            }

            return $posts;
            }
        else
        {
            return false;
        }
    }

    private function generate_post_id()
    {
         $id = '';
         for($i = 0; $i < 9; $i++)
         {
             $id .= rand(0, 10);
         }

         $result = $this->get_post_for_id($id);

         if($result != null)
         {
             // if it already exists, run it again
             return $this->generate_post_id();
         }
         else
         {
             return $id;
         }
    }

    
}

