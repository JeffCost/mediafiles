<table border="0" class="table table-bordered">
    <thead>
        <tr>
            <th width="10%">{{ __('mediafiles::lang.#')->get(ADM_LANG) }}</th>
            <th>{{ __('mediafiles::lang.Name')->get(ADM_LANG) }}</th>
            <th>{{ __('mediafiles::lang.Description')->get(ADM_LANG) }}</th>
            <th>{{ __('mediafiles::lang.Downloads')->get(ADM_LANG) }}</th>
            <th>{{ __('mediafiles::lang.Status')->get(ADM_LANG) }}</th>
            <th width="200" class="collapse"></th>
        </tr>
    </thead>
    <tbody class="sortable">
    @if(isset($records) and !empty($records))
    @foreach($records as $record)
        <tr id="record-id-{{$record->id}}" class="handle" data-id="{{ $record->id }}">
            <td>
                <?php echo \Thumbnails\Html::thumbnail(DS.Config::get('mediafiles::settings.image_url').DS.$record->image_name,
                    array(
                        'mode' => 'outbound',
                        'size' => '100x100',
                        'alt'  => 'record-'.$record->id,
                        'attr' => array(
                            'data-record-id' => $record->id, 
                            'style'          => 'width: 100; height: 100;'),
                        )
                    ) 
                ?>
            </td>
            <td class="align-center">{{ Str::title($record->name) }}</td>

            <td class="align-center">{{ $record->description }}</td>

            <td class="align-center">{{ $record->count }}</td>
            
            <td><?php if($record->status == 0) {echo  __('mediafiles::lang.Disabled')->get(ADM_LANG);} else { echo __('mediafiles::lang.Enabled')->get(ADM_LANG); } ?></td>
            <td class="collapse actions">
                
                <a href="{{ URL::base() . '/'.ADM_URI.'/'}}mediafiles/{{ $record->id }}/edit" class="btn btn-mini"><i class="icon-edit"></i> {{ __('mediafiles::lang.Edit')->get(ADM_LANG) }}</a>
                
                <a data-module="mediafiles" data-verb="DELETE" data-title="{{ __('mediafiles::lang.Are you sure to destroy the this record?')->get(ADM_LANG)}}" class="confirm btn btn-danger btn-mini delete" href="{{ URL::base().'/'.ADM_URI }}/mediafiles/{{ $record->id }}"><i class="icon-trash icon-white"></i> {{ Lang::line('mediafiles::lang.Delete')->get(ADM_LANG) }}</a>
            </td>
        </tr>
    @endforeach
    @else
    <tr>
        <td colspan="5" style="text-align:center;">{{ __('mediafiles::lang.No records were found')->get(ADM_LANG) }}</td>
    </tr>
    @endif
    </tbody>
</table>