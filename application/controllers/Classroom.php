<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom extends MY_Controller {
    public function __construct() {

        # Load Models
        $this->models = array('service_order', 'user', 'cluster', 'classroom', 'computer');

        parent::__construct();

        # Load itmms Session Data
        $this->get_session_data();

        # Check if user is currently logged in
        if(!$this->data['sess_is_logged_in']) {
            redirect( base_url() );
        }
    }

    public function classroom() {
        if($this->data['sess_access_rights'] !== 'ultimate_control' && $this->data['sess_access_rights'] !== 'full_control' ){
            redirect( '403' );
        }
        else {
            $this->template = 'includes/layout';

            $this
                 // Scripts
                 ->add_local_scripts('assets/js/itmms/classroom/classroom');
        }
    }

    public function classroom_list() {
        if($this->data['sess_access_rights'] !== 'ultimate_control' && $this->data['sess_access_rights'] !== 'full_control' ){
            redirect( '403' );
        }
        else {
            $this->template = 'includes/layout';

            $this
                 // Styles
                 ->add_local_styles('assets/css/datatables/datatables-bootstrap')
                 ->add_local_styles('assets/css/datatables/responsive.bootstrap', TRUE)
                 // Scripts
                 ->add_local_scripts('assets/js/datatables/datatables-jquery')
                 ->add_local_scripts('assets/js/datatables/datatables-bootstrap', TRUE)
                 ->add_local_scripts('assets/js/datatables/dataTables.responsive', TRUE)

                 ->add_local_scripts('assets/js/itmms/classroom/classroom_list');
        }
    }

    public function eroom_ws($classroom) {
        $classroom = urldecode($classroom);
        $this->data['query'] = $this->classroom->show_rooms(strtolower($classroom), 'lecture');
        $this->template = 'includes/layout';

        $this
             // Styles
             ->add_local_styles('assets/css/datatables/datatables-bootstrap')
             ->add_local_styles('assets/css/datatables/responsive.bootstrap', TRUE)
             // Scripts
             ->add_local_scripts('assets/js/datatables/datatables-jquery')
             ->add_local_scripts('assets/js/datatables/datatables-bootstrap', TRUE)
             ->add_local_scripts('assets/js/datatables/dataTables.responsive', TRUE)

             ->add_local_scripts('assets/js/itmms/computer/computer_history');
    }

    public function laboratory_ws($classroom) {
        $classroom = urldecode($classroom);
        $this->data['query'] = $this->classroom->show_rooms(strtolower($classroom), 'laboratory');
        $this->template = 'includes/layout';

        $this
             // Styles
             ->add_local_styles('assets/css/datatables/datatables-bootstrap')
             ->add_local_styles('assets/css/datatables/responsive.bootstrap', TRUE)
             // Scripts
             ->add_local_scripts('assets/js/datatables/datatables-jquery')
             ->add_local_scripts('assets/js/datatables/datatables-bootstrap', TRUE)
             ->add_local_scripts('assets/js/datatables/dataTables.responsive', TRUE)

             ->add_local_scripts('assets/js/itmms/computer/computer_history');
    }
}
