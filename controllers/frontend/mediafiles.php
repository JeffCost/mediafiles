<?php

class Mediafiles_Frontend_Mediafiles_Controller extends Public_Controller {

    public function get_index()
    {
        $this->data['meta_title'] = 'Downloads';
        $this->data['records'] = \Mediafiles\Model\File::where_status(1)->order_by('order', 'asc')->get();
        return $this->theme->render('mediafiles::frontend.files.index', $this->data);
    }

    public function post_update_counter()
    {
        $post_data = Input::all();
        if(isset($post_data['id']) and ctype_digit($post_data['id']))
        {
            $file = \Mediafiles\Model\File::find($post_data['id']);
            if(isset($file) and !empty($file))
            {
                $file->count += 1;
                $file->save();
                return '{"count" : '.$file->count.'}';
            }
        }
        return '{"count" : 0}';
    }
}