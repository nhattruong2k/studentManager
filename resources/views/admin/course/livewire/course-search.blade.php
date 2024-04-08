@push('style')
    <style>
        /* #myInput {
                background-image: url('/css/searchicon.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
                width: 100%;
                font-size: 16px;
                padding: 12px 20px 12px 40px;
                border: 1px solid #ddd;
                margin-bottom: 12px;
            } */
    </style>
@endpush
<div>
    <div class="card-header">
        <div class="card-tools">
            <div class="input-group input-group-sm">
                <div class="input-group input-group-sm d-flex">
                    <input class="" type="text" name="search" id="myInput" onkeyup="myFunction()"
                        placeholder="Search for names.." title="Type in a name">
                    <div>
                        <button class="btn btn-primary ml-2" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
