<?php themes\add_asset('archive.css', 'mod: mediafiles/css', array(), 'page') ?>
<?php themes\add_asset('counter.js', 'mod: mediafiles/js', array('scripts'), 'footer') ?>
<?php if(isset($records) and !empty($records)): ?>
    <?php foreach ($records as $record): ?>
    {{ View::make('mediafiles::frontend.files.file', array('record' => $record)) }}
    <?php endforeach ?>
<?php endif ?>