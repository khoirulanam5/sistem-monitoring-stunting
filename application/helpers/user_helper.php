<?php

	function ispimpinan() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'PIMPINAN') {
			redirect('auth');
		}
	}

	function isadmin() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'ADMIN') {
			redirect('auth');
		}
	}

	function ispetugas() {
		$ci = get_instance();
		$level = $ci->session->userdata('level');
		if ($level != 'PETUGAS') {
			redirect('auth');
		}
	}

    function ispenerima() {
        $ci = get_instance();
        $level = $ci->session->userdata('level');
        if ($level != 'PENERIMA') {
            redirect('auth');
        }
    }