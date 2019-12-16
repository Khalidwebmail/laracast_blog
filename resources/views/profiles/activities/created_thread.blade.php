
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <span class="flex">
                {{ $profile_user->name }} published thread
            </span>
        </div>
    </div>
    <div class="panel-body">
        {{ $activity->subject->body }}
    </div>
</div>