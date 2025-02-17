<div class="favorite-list-item">
    <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
        style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar) }}');">
    </div>
    <?php $fname = $user->first_name . ' ' . $user->last_name ?>
    {{ strlen($fname) > 12 ? trim(substr($fname,0,12)).'..' : $fname }}
</div>
