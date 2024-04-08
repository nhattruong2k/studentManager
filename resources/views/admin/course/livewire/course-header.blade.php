<div>
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <div class="card-tools">
            <div class="input-group input-group-sm">
                <ul class="d-flex">
                    <li><a href="{{ route(\App\Models\Course::CREATE) }}" class="btn btn-primary mr-1"
                            data-target="#crudCourseModal">
                            <i class="fa fa-plus-square"></i> {{ __('common.create') }}
                        </a>
                    </li>
                    <li><a href="{{ route(\App\Models\Course::LIST) }}" class="btn btn-default"><i
                                class="fa fa-refresh"></i> {{ __('common.reload') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
