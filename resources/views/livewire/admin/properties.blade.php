<div class="table-responsive" tabindex="8">
    <div class="form-group row">
        <label  class="col-sm-2 col-form-label">عنوان جستجو</label>
        <div class="col-sm-10">
            <input type="text" class="form-control text-left"  dir="rtl" wire:model="search" >
        </div>
    </div>
    <table class="table table-striped table-hover overflow-auto">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">ردیف</th>
            <th class="text-center align-middle text-primary">عنوان  مشخصات</th>
            <th class="text-center align-middle text-primary">گروه مشخصات</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
            <th class="text-center align-middle text-primary">ویرایش</th>
            <th class="text-center align-middle text-primary">حذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($properties as $index => $property)
            <tr>
                <td class="text-center align-middle">{{$properties->firstItem() + $index  }}</td>
                <td class="text-center align-middle">{{$property->title}}</td>
                <td class="text-center align-middle">{{$property->property_groups->title}}</td>
                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($property->created_at)->format('%B %d، %Y')}}</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('properties.edit',$property->id)}}">
                        ویرایش
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-danger" wire:click="deleteProperty({{$property->id}})">
                        حذف
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$properties->appends(Request::except('page'))->links()}}
    </div>
</div>
