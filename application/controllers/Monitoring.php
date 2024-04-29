<?php
defined('BASEPATH') or exit('No direct script access allowed');

class monitoring extends MY_Controller
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

        if ($this->data['sess_access_rights'] !== 'ultimate_control' && $this->data['sess_access_rights'] !== 'full_control') {
            redirect('403');
        }
    }

    public function monitoring()
    {
        $this->template = 'includes/layout';

        $this
            // Styles
            ->add_local_styles('assets/css/datatables/datatables-bootstrap')
            ->add_local_styles('assets/css/datatables/responsive.bootstrap', TRUE)
            // Scripts
            ->add_local_scripts('assets/js/datatables/datatables-jquery')
            ->add_local_scripts('assets/js/datatables/datatables-bootstrap', TRUE)
            ->add_local_scripts('assets/js/datatables/dataTables.responsive', TRUE)
            ->add_local_scripts('assets/js/moment/moment')
            ->add_local_scripts('assets/js/tippy/popper')
            ->add_local_scripts('assets/js/tippy/tippy')

            ->add_local_scripts('assets/js/itmms/monitoring/monitoring');
    }

    public function monitoring_view_parts($computer_id)
    {
        $this->template = 'includes/layout';
        $this->data['query'] = $this->computer->get_computer_parts($computer_id);
        $this->data['computer'] = $this->computer->get_computer_details_by_id($computer_id);

        $computer_parts = $this->data['query'];
        foreach ($computer_parts as $cp) {
            if (in_array(strtolower($cp->parts_name), ['computer set', "branded", "cloned"])) {
                $this->data['replaced_parts'] = $this->computer->get_replaced_parts($this->data['computer']->computer_name);
                break;
            }
        }

        $this
            ->add_local_scripts('assets/js/moment/moment')
            ->add_local_scripts('assets/js/chartjs/chart.umd.min')
            ->add_local_scripts('assets/js/chartjs/chartjs-adapter-moment')
            ->add_local_scripts('assets/js/itmms/monitoring/monitoring-view-parts');
    }
}
