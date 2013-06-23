<?php

class Mediafiles_Frontend_Mediafiles_Controller extends Public_Controller {

    public function get_index()
    {
        $this->data['meta_title'] = 'Downloads';
        $this->data['records'] = \Mediafiles\Model\File::where_status(1)->order_by('order', 'desc')->get();
        return $this->theme->render('mediafiles::frontend.files.index', $this->data);
    }
}