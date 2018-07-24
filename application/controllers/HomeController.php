<?php

// use Library\Controller;

class HomeController extends Controller {

    function index($request) {
        if ($request->getCookie('slova') === 'cirilica') {
            $bla = 'cir';
        } else {
            $bla = 'lat';
        }

        $this->view('home/index.' . $bla);
    }
}
