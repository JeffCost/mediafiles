<?php themes\add_asset('downloads.js', 'mod: mediafiles/js', array('scripts'), 'footer') ?>

@if(isset($records) and !empty($records))
<div class="row" style="margin-top:25px;">
    <div class="span12">
            {{ View::make('mediafiles::backend.files.files_table', array('records' => $records)) }}
    </div>
</div>
@else
<div class="row" style="margin-top:25px;">
    <div class="span12">
        
        <div class="offset4">
            <br />
            {{HTML::link_to_action(ADM_URI.'/'.'mediafiles@new', 'Add New', array(), array('class' => 'btn btn-primary')) }}
        </div>
    </div>
</div>
@endif
