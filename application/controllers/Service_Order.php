<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service_Order extends MY_Controller
{

    public function __construct()
    {

        # Load Models
        $this->models = array('service_order', 'user', 'cluster', 'classroom', 'computer');

        parent::__construct();

        # Load itmms Session Data
        $this->get_session_data();

        # Check if user is currently logged in
        if (!$this->data['sess_is_logged_in']) {
            redirect(base_url());
        }
    }

    public function service_order()
    {
        if ($this->data['sess_access_rights'] === 'view') {
            redirect('403');
        } else {
            $this->template = 'includes/layout';

            $this
                // Styles
                ->add_local_styles('assets/css/itmms/itmms-typeahead')
                ->add_local_styles('assets/css/select2/select2.min')
                // Script
                ->add_local_scripts('assets/js/typeahead/typeahead.bundle', TRUE)
                ->add_local_scripts('assets/js/select2/select2.full.min')
                ->add_local_scripts('assets/js/itmms/service_order/service-order');
        }
    }
}
