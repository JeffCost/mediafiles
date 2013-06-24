<?php

class Mediafiles_Backend_Mediafiles_Controller extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->data['section_bar'] = array(
            Lang::line('mediafiles::lang.Files')->get(ADM_LANG)    => URL::base().'/'.ADM_URI.'/mediafiles',
            Lang::line('mediafiles::lang.New')->get(ADM_LANG) => URL::base().'/'.ADM_URI.'/mediafiles/new',
        );

        $this->data['bar'] = array(
            'title'       => Lang::line('mediafiles::lang.Media Files')->get(ADM_LANG),
            'url'         => URL::base().'/'.ADM_URI.'/mediafiles',
            'description' => Lang::line('mediafiles::lang.Provides an interface to upload files and make them available to download')->get(ADM_LANG),
        );
    }

    public function get_index()
    {
        $this->data['section_bar_active'] = Lang::line('mediafiles::lang.Files')->get(ADM_LANG);

        $this->data['records'] = \Mediafiles\Model\File::where_status(1)->get();

        return $this->theme->render('mediafiles::backend.files.index', $this->data);
    }

    public function get_edit($id)
    {
        $this->data['section_bar'] = array(
            Lang::line('mediafiles::lang.Files')->get(ADM_LANG)    => URL::base().'/'.ADM_URI.'/mediafiles',
            Lang::line('mediafiles::lang.New')->get(ADM_LANG) => URL::base().'/'.ADM_URI.'/mediafiles/new',
            Lang::line('mediafiles::lang.Edit')->get(ADM_LANG) => URL::base().'/'.ADM_URI.'/mediafiles/'.$id.'/edit',
        );
        $this->data['section_bar_active'] = Lang::line('mediafiles::lang.Edit')->get(ADM_LANG);

        $this->data['record'] = \Mediafiles\Model\File::find($id);

        return $this->theme->render('mediafiles::backend.files.edit', $this->data);
    }

    public function get_new()
    {
        $this->data['section_bar_active'] = Lang::line('mediafiles::lang.New')->get(ADM_LANG);

        return $this->theme->render('mediafiles::backend.files.new',$this->data);
    }

    public function post_create()
    {
        $post_data = Input::all();

        $rules = array(
            'name'        => 'required|max:100',
            'description' => 'max:255',
            'version'     => 'max:1000',
            'file'        => 'required',
            'image'       => 'image',
        );

        $validation = Validator::make($post_data, $rules);

        if ($validation->passes())
        {
            $mediafile = new \Mediafiles\Model\File;
            
            // Media File Image
            if($this->has_data($post_data, 'image'))
            {
                $image_path      = Config::get('mediafiles::settings.image_path');
                $image_name      = \Opensim\UUID::random();
                $image_ext       = '.'.get_file_extension($post_data['image']['name']);
                $image_full_name =  $image_name.$image_ext;
                $image           = Input::upload('image', $image_path, $image_full_name);

                if($image)
                {
                    if(isset($image) and !empty($image))
                    {
                        $mediafile->image_name = $image_full_name;
                    }
                }
            }

            // Media File Archive
            $file_path      = Config::get('mediafiles::settings.file_path');
            $file_name      = $post_data['file']['name'];
            $file_ext       = '.'.get_file_extension($file_name);
            $file_full_name = $file_name;
            $file           = Input::upload('file', $file_path, $file_full_name);

            if($file)
            {
                if(isset($file) and !empty($file))
                {
                    $mediafile->file_name = $file_full_name;
                }
            }

            $mediafile->name        = $post_data['name'];
            $mediafile->description = $post_data['description'];
            $mediafile->version     = $post_data['version'];
            $mediafile->save();


            $this->data['message']      = __('mediafiles::lang.Custom avatar was successfully created')->get(ADM_LANG);
            $this->data['message_type'] = 'success';
            
            return Redirect::to(ADM_URI.'/mediafiles')->with($this->data);
            
        }

        return Redirect::to(ADM_URI.'/mediafiles/new')->with('errors', $validation->errors)
                                                  ->with_input();
    }

    public function put_update($id)
    {
        $post_data = Input::all();

        $rules = array(
            'name'        => 'required|max:100',
            'description' => 'max:1000',
            'version'     => 'max:100',
        );

        $validation = Validator::make($post_data, $rules);

        if ($validation->passes())
        {
            $mediafile = Mediafiles\Model\File::find($id);

            // Media File Image
            if($this->has_data($post_data, 'image'))
            {
                // Delete old image
                $this->delete_image($mediafile->image_name);

                $image_path      = Config::get('mediafiles::settings.image_path');
                $image_name      = Opensim\UUID::random();
                $image_ext       = '.'.get_file_extension($post_data['image']['name']);
                $image_full_name =  $image_name.$image_ext;
                $image           = Input::upload('image', $image_path, $image_full_name);

                if($image)
                {
                    if(isset($image) and !empty($image))
                    {
                        $mediafile->image_name = $image_full_name;
                    }
                }
            }

            // Media File Archive
            if($this->has_data($post_data, 'file'))
            {
                // Delete old file
                $this->delete_file($mediafile->file_name);

                $file_path      = Config::get('mediafiles::settings.file_path');
                $file_name      = $post_data['file']['name'];
                $file_ext       = '.'.get_file_extension($file_name);
                $file_full_name = $file_name;
                $file           = Input::upload('file', $file_path, $file_full_name);

                if($file)
                {
                    if(isset($file) and !empty($file))
                    {
                        $mediafile->file_name = $file_full_name;
                    }
                }
            }

            $mediafile->name        = $post_data['name'];
            $mediafile->description = $post_data['description'];
            $mediafile->version     = $post_data['version'];
            $mediafile->save();

            $this->data['message']      = __('mediafiles::lang.Custom avatar was successfully created')->get(ADM_LANG);
            $this->data['message_type'] = 'success';
            
            return Redirect::to(ADM_URI.'/mediafiles')->with($this->data);
            
        }

        return Redirect::to(ADM_URI.'/mediafiles/new')->with('errors', $validation->errors)
                                                  ->with_input();

    }

    public function delete_destroy($id)
    {
        $record = \Mediafiles\Model\File::find($id);
        if(isset($record) and !empty($record))
        {
            // Delete file
            $this->delete_file($record->file_name);
            
            // Delete Image
            $this->delete_image($record->image_name);
            
            $record->delete();
            
            $this->data['message']      = __('mediafiles::lang.File was successfully deleted')->get(ADM_LANG);
            $this->data['message_type'] = 'success';
        }
        else
        {
            $this->data['message']      = __('mediafiles::lang.File was was not found')->get(ADM_LANG);
            $this->data['message_type'] = 'error';
        }

        if(Request::ajax())
        {
            $data = array(
                'flash_message'    => array(
                    'message_type' => $this->data['message_type'],
                    'messages'     => array($this->data['message']),
                ),
                'hide'           => array(
                    'identifier' => 'tr#record-id-'.$id,
                ),
            );
                
            return json_encode($data);
        }

        return Redirect::to(ADM_URI.'/mediafiles')->with($this->data);
    }

    private function delete_image($image_name)
    {
        // Remove Images
        File::delete(Config::get('mediafiles::settings.image_path').DS.$image_name);
        // Remove thumbnails
        File::delete(path('public').Config::get('thumbnails::options.image_path').DS.'100x100'.DS.'outbound-'.$image_name);
    }

    private function delete_file($file_name)
    {
        // Remove File
        File::delete(Config::get('mediafiles::settings.file_path').DS.$file_name);
    }

    private function has_data($input, $field)
    {
        if(isset($input[$field]))
        {
            if(isset($input[$field]['error']) and $input[$field]['error'] != 4 and $input[$field]['tmp_name'] != '' and $input[$field]['name'] != '')
            {
                return true;
            }
        }

        return false;
    }
}