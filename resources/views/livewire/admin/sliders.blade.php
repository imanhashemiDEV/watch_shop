<div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
    <div class="form-group row">
        <label  class="col-sm-2 col-form-label">عنوان جستجو</label>
        <div class="col-sm-10">
            <input type="text" class="form-control text-left"  dir="rtl" wire:model="search" >
        </div>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">ردیف</th>
            <th class="text-center align-middle text-primary">عکس</th>
            <th class="text-center align-middle text-primary">عنوان </th>
            <th class="text-center align-middle text-primary">ویرایش</th>
            <th class="text-center align-middle text-primary">حذف</th>
            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sliders as $index => $slider)
            <tr>
                <td class="text-center align-middle">{{$sliders->firstItem() + $index}}</td>
                <td class="text-center align-middle">
                    <figure>
                        <img src="{{ url('images/sliders/small/' . $slider->image) }}"
                            class="rounded" alt="image">
                    </figure>
                </td>
                <td class="text-center align-middle">{{$slider->title}}</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('sliders.edit',$slider->id)}}">
                         ویرایش
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-danger" wire:click="deleteSlider({{$slider->id}})">
                        حذف
                    </a>
                </td>
                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($slider->created_at)->format('%B %d، %Y')}}</td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$sliders->appends(Request::except('page'))->links()}}
    </div>
</div>
