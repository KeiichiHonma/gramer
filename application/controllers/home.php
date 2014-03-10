<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('image');
        $this->load->helper('weather');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->lang->load('common');
        $this->lang->load('setting');
        $this->data = array();
    }

    /**
     * search area action
     *
     */
    function index()
    {
        if(strcasecmp($_SERVER['REQUEST_METHOD'],'POST') === 0){
            $this->form_validation->set_rules('name', $this->lang->line('contact_name'), "required|trim|xss_clean|strip_tags|htmlspecialchars|min_length[{$this->config->item('name_min_length')}]|max_length[{$this->config->item('name_max_length')}]");
            $this->form_validation->set_rules('email', $this->lang->line('contact_email'), 'required|trim|xss_clean|valid_email');
            $this->form_validation->set_rules('url', $this->lang->line('contact_url'), 'trim|xss_clean|valid_url');
            $this->form_validation->set_rules('type', $this->lang->line('contact_type'), 'required|trim|xss_clean');
            $this->form_validation->set_rules('comments', $this->lang->line('contact_comments'), "required|xss_clean|htmlspecialchars|strip_tags|max_length[{$this->config->item('contact_comments_max_length')}]");
            if($this->form_validation->run() == TRUE){
                $contactData['name'] = $this->input->post('name');
                $contactData['email'] = $this->input->post('email');
                $contactData['url'] = $this->input->post('url');
                $contactData['type'] = $this->input->post('type');
                $contactData['comments'] = $this->input->post('comments');
                
                $this->_send_email('contact',$this->input->post('email'), $contactData);
                $this->session->set_flashdata('notify', $this->lang->line('contact_notify_message'));
                redirect("");
            }
        }
        $data['bodyId'] = 'area';
        $data['search_type'] = 'area';//sp

        $data['topicpaths'][] = array('/',$this->lang->line('topicpath_home'));
        $data['topicpaths'][] = array('/#about',$this->lang->line('topicpath_about'));
        $data['topicpaths'][] = array('/#service',$this->lang->line('topicpath_service'));
        $data['topicpaths'][] = array('/#works',$this->lang->line('topicpath_works'));
        $data['topicpaths'][] = array('/#contact',$this->lang->line('topicpath_contact'));

        //set header title
        //$data['og_image'] = site_url('/images/area/big/'.$area_id.'_big.jpg');
        $data['header_title'] = $this->lang->line('common_header_title');
        $data['header_keywords'] = $this->lang->line('common_header_keywords');
        $data['header_description'] = $this->lang->line('common_header_description');

        $this->config->set_item('stylesheets', array_merge($this->config->item('stylesheets'), array('css/jquery.notifyBar.css')));
        $this->config->set_item('javascripts', array_merge($this->config->item('javascripts'), array('js/scrolltop.js','js/jquery.notifyBar.js')));
        
        $this->load->view('home/index', array_merge($this->data,$data));
    }

    /**
     * Send email message of given type (activate, forgot_password, etc.)
     *
     * @param    string
     * @param    string
     * @param    array
     * @return    void
     */
    function _send_email($type,$email, &$data)
    {
        $config = array(
            'charset' => 'utf-8',
            'mailtype' => 'text'
        );
        $this->load->library('email',$config);
        $this->email->initialize($config);
        $data['site_name'] = $this->config->item('website_name', 'tank_auth');
        
        $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
        $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
        $this->email->to($email);
        $this->email->bcc($this->config->item('webmaster_email', 'tank_auth'));
        $subject = sprintf($this->lang->line($type.'_subject'), $this->config->item('website_name', 'tank_auth'));
        $this->email->subject($subject);
        $this->email->message($this->load->view('email/'.$type.'-txt', $data, TRUE));
        $this->email->send();
    }
}

/* End of file search.php */
/* Location: ./application/controllers/search.php */