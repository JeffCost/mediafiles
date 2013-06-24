<?php

class Mediafiles_Backend_Ajax_Controller extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function put_sort()
    {
        $post_data = Input::get('order');
        
        if(isset($post_data) and !empty($post_data))
        {
            $order_items = explode(',', $post_data);
            foreach ($order_items as $order_position => $slug)
            {
                $affected = Mediafiles\Model\File::where_id($slug)
                               ->update(array('order' => $order_position));
            }
            return;
        }
    }
}
