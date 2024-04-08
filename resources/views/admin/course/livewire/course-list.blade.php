<div>
    <div class="card-body container-fluid">
        <table class="table table-bordered table-hover" id="myTable">
            <thead>
                <tr class="text-center">
                    {{-- <th class="rowCheckAll w_30 text-center"><input type="checkbox" id="checkAll" /></th> --}}
                    <th class="">STT</th>
                    <th class="">Code</th>
                    <th class="">Name</th>
                    <th class="">Status</th>
                    <th class="">{{ __('common.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coursets as $key => $courset)
                    <tr>
                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $courset->ma_khoa_hoc }}</td>
                        <td class="align-middle name">{{ $courset->ten_khoa_hoc }}</td>
                        <td class="align-middle">
                            @if ($courset->status == 0)
                                <p
                                    class="bg-secondary bg-gradient p-1 fs-6 text-center text-dark bg-opacity-10 fw-bolder border border-secondary rounded">
                                    <i class="fas fa-sticky-note" style="color: #d5d6d8;"></i> BNgừng kích hoạt
                                </p>
                            @elseif ($courset->status == 1)
                                <p
                                    class="bg-success bg-gradient p-1 fs-6 text-center text-dark bg-opacity-10 fw-bolder border border-success rounded">
                                    <i class="fas fa-check" style="color: #00ff7b;"></i> Kích Hoạt
                                </p>
                            @elseif ($courset->status == 2)
                                <p
                                    class="bg-warning bg-gradient p-1 fs-6 text-center text-dark bg-opacity-10 fw-bolder border border-warning rounded">
                                    <i class="fas fa-check-double" style="color: #fbff00;"></i> Tạm dừng
                                </p>
                            @endif
                        </td>
                        <td class="action text-center align-middle">
                            <a href="{{ route(\App\Models\Course::UPDATE, $courset->id) }}" class="btn btn-primary"
                                title="{{ trans('common.edit') }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            {{-- <a href="javascript:;" onclick="deleteModal('{{ $courset->id }}', 'courses/destroy')"
                                title="{{ trans('common.delete') }}" class="btn btn-danger"><i
                                    class="fa fa-trash-o"></i></a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer-table row">
            <div class="col-sm-6 d-flex">
                <div class="box-numpaging">
                    {!! Form::select('numpaging', App\Libs\Constants::$list_numpaging, Request::get('numpaging'), [
                        'class' => 'form-control select',
                        'id' => 'selectNumpaging',
                    ]) !!}
                </div>
                <span class="total-record ml-2 mt-2">{!! __('common.total_data', ['total' => $coursets->count()]) !!}</span>
            </div>
            <div class="col-sm-6">
                <div class="pull-right">
                    {{-- {{ $coursets->links('vendor/pagination/bootstrap-4') }} --}}
                </div>

            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endpush
