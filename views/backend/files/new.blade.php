<div style="margin-top:25px;" class="row">
    <div class="span12">
        {{Form::open_for_files( URL::base() .'/'.ADM_URI.'/mediafiles', 'POST', array('class' => 'form-horizontal'))}}
        <div style="display:none">
            {{ Form::token() }}
        </div>
        <div class="form_inputs">

            <div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
                <label for="name" class="control-label">{{ Lang::line('mediafiles::lang.Name')->get(ADM_LANG) }}</label>
                <div class="controls">
                    {{ Form::text('name', Input::old('name', '')) }}
                    <span class="required-icon"></span>
                    <span class="help-inline">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                </div>
            </div>

            <div class="control-group {{ $errors->has('description') ? 'error' : '' }}">
                <label for="description" class="control-label">{{ Lang::line('mediafiles::lang.Description')->get(ADM_LANG) }}</label>
                <div class="controls">
                    {{ Form::text('description', Input::old('description', '')) }}
                    <span class="help-inline">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                </div>
            </div>

            <div class="control-group {{ $errors->has('version') ? 'error' : '' }}">
                <label for="version" class="control-label">{{ Lang::line('mediafiles::lang.Version')->get(ADM_LANG) }}</label>
                <div class="controls">
                    {{ Form::text('version', Input::old('version', '')) }}
                    <span class="help-inline">{{ $errors->has('version') ? $errors->first('version') : '' }}</span>
                </div>
            </div>

            <div class="control-group {{ $errors->has('image') ? 'error' : '' }}">
                <label for="image" class="control-label">{{ Lang::line('mediafiles::lang.Image')->get(ADM_LANG) }}</label>
                <div class="controls">
                    {{ Form::file('image') }}
                    <span class="help-inline">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                </div>
            </div>

            <div class="control-group {{ $errors->has('file') ? 'error' : '' }}">
                <label for="file" class="control-label">{{ Lang::line('mediafiles::lang.Archive')->get(ADM_LANG) }}</label>
                <div class="controls">
                    {{ Form::file('file') }}
                    <span class="help-inline">{{ $errors->has('file') ? $errors->first('file') : '' }}</span>
                </div>
            </div>

            <div class="control-group {{ $errors->has('status') ? 'error' : '' }}">
                <label for="status" class="control-label">{{ Lang::line('mediafiles::lang.Status')->get(ADM_LANG) }}</label>
                <div class="controls">
                    {{ Form::select('status', array(0 => Lang::line('mediafiles::lang.Disabled')->get(ADM_LANG), 1 => Lang::line('mediafiles::lang.Enabled')->get(ADM_LANG)), Input::old('status', 1)) }}
                    <span class="help-inline">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                </div>
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ URL::base() .'/'.ADM_URI}}/downloads/" class="btn">{{ __('mediafiles::lang.Cancel')->get(ADM_LANG) }}</a> 
            <button type="submit" name="btnAction" value="save" class="btn btn-primary">
                <span>{{ __('mediafiles::lang.Create')->get(ADM_LANG) }}</span>
            </button>
        </div>
        {{Form::close()}}
    </div>
</div>