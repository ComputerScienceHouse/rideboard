<?php
/**
 * Page_Framework.php
 *
 * Class used for loading and displaying pages from the default template.
 *
 * @author Sean McGary <sean.mcgary@gmail.com>
 */
class Page_Framework
{

    public $CI;
    public $javascript = array();
    public $css = array();
    public $header_data = array();
    public $pre_css = array();
    public $left_data;

    public function  __construct()
    {
        $this->CI = get_instance();
        $this->CI->load->model('group_model');
    }

    public function load_javascript($source)
    {
        $this->javascript[] = $source;
    }

    public function load_css($source)
    {
        $this->css[] = $source;
    }

    public function load_pre_css($source)
    {
        $this->pre_css[] = $source;
    }

    public function generate_leftCol_default()
    {
        $data = array();


        return $data;
    }

    public function set_left_col_data($data)
    {
        $this->left_data = $data;
    }

    public function set_header_data($data)
    {
        $this->header_data = array_merge($this->header_data, $data);
    }


    
    /**
     *
     * @param string $main_page     The main view file to load
     * @param array $data           Data to load. Each page has an index.
     *                                  IE: $data['header'] is for the header
     * @param string $other_col     The other view file to load
     */
    public function render($rightCol, $rightCol_data, $leftCol = null, $leftCol_data = array())
    {
        $header_data = array();
        $header_data['javascript'] = $this->javascript;
        $header_data['css'] = $this->css;
        $header_data['pre_css'] = $this->pre_css;

        $groups = $this->CI->group_model->get_groups();

        $header_data = array_merge($this->header_data, $header_data);
        
        // load header
        $this->CI->load->view('template/header_view', $header_data);
        if($leftCol != null)
        {

            $this->CI->load->view($leftCol, $leftCol_data);
        }
        else
        {

            $leftCol_data['groups'] = $this->CI->load->view('presenters/leftCol/leftCol', array('groups' => $groups), true);
            $this->CI->load->view('template/leftColDefault_view', $leftCol_data);
        }
        $this->CI->load->view($rightCol, $rightCol_data);

        $footer_data = array();
        $footer_data['group_dropdown'] = $this->CI->load->view('presenters/footer/group_dropdown', array('groups' => $groups), true);
        
        $this->CI->load->view('template/footer_view', $footer_data);
        
    }
}
?>
