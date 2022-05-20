@extends('admin.layouts.master')
@include('admin.partials.header',[$title='  اضافه کردن ویژگی محصول'])
@section('content')
    <!-- begin::main content -->
    <main class="main-content">
        <div class="row">
            @if(Session::has('message'))
                <div class="alert alert-info">
                    <div>{{session('message')}}</div>
                </div>
            @endif
        </div>
        @include('admin.partials.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">اضافه کردن ویژگی محصول  </h6>
                    <form role="form" method="POST" action="{{route('store.product.properties',$product->id)}}"
                        enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">


                                @foreach($property_groups as $property_group)


                                          <div class="mt-2 row">
                                              <div class="col-sm-4">
                                                  <label for="title">{{$property_group->title}}:</label>
                                              </div>
                                              <div class="col-sm-8 padding-0-18">
                                                <select class="form-select" name="properties[]" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                    @foreach($property_group->properties()->pluck('title','id') as $key=>$value)

                                                            @if (in_array($key,$product->properties()->pluck('id')->toArray()))
                                                               <option selected value="{{$key}}">{{ $value}}</option>
                                                            @else
                                                               <option value="{{$key}}">{{$value}}</option>
                                                            @endif



                                                    @endforeach
                                                </select>
                                              </div>
                                          </div>
                                  @endforeach
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                          <button type="submit" class="btn btn-primary">ثبت</button>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </main>
    <!-- end::main content -->
@endsection
@section('scripts')
    <script>

        $(document).ready(function () {

            $('#customFile').on('change', function () {
                //get the file name
                var fileName = $(this).val().replace('C:\\fakepath\\', " ")
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })

        });

        $('.form-select').select2();

    </script>
@endsection
