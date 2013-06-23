<!-- <div class="mediafile"> -->
<div class="span9">
    <div class="mediafile-image">
        <?php echo \Thumbnails\Html::thumbnail(DS.Config::get('mediafiles::settings.image_url').DS.$record->image_name,
            array(
                'mode' => 'outbound',
                'size' => '100x100',
                'alt'  => Str::title($record->name),
                'attr' => array(
                    'data-file-id' => $record->id, 
                    'style'        => 'width: 100px; height: 100px;'),
                )
            ) 
        ?>
    <div class="mediafile-info">
        <h4 class="title">
            {{ $record->name }}
        </h4>
    </div>
    <p class="mediafile-details">{{ $record->description }}
    <ul class="mediafile-stats">
        @if(!empty($record->version))
        <li>Version: {{ $record->version }}</li>
        @endif
        
        <li>Downloads: {{ $record->count }}</li>
            <li><a style="margin-top:10px" href="/{{ Config::get('mediafiles::settings.file_url').DS.$record->file_name }}" class="btn btn-mini btn-success">Download</a></li>
    </ul>
    </p>
</div>
