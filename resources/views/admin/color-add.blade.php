@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Color infomation</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.colors') }}">
                            <div class="text-tiny">{{__('messages.Colors')}}</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">{{__('messages.New Color')}}</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.color.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">{{__('messages.Color Name')}} <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="{{__('messages.Color Name')}}" name="name" tabindex="0" value="{{ old('name') }}" aria-required="true" required="">
                    </fieldset>
                    @error('name')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">{{__('messages.Color Slug')}} <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="{{__('messages.Brand Slug')}}" name="slug" tabindex="0" value="{{ old('slug') }}" aria-required="true" required="">
                    </fieldset>
                    @error('slug')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <fieldset class="code">
                        <div class="body-title">{{__('messages.Color Code')}} <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="{{__('messages.Color code')}}" name="code" tabindex="0" value="{{ old('code') }}" aria-required="true" required="">
                    </fieldset>
                    @error('code')
                    <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror


                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">{{__('messages.Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $("#myFile").on("change", function(e){
                const photoInp = $("#myFile");
                const [file] = this.files;
                if(file)
                {
                    $("#imgpreview img").attr('src',URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });

            $("input[name='name']").on("change", function(){
                $("input[name='slug']").val(StringToSlug($(this).val()));
            });
        });

        function StringToSlug(Text)
        {
            return Text.toLowerCase().replace(/[^\w ]+/g, "").replace(/ +/g,"-");
        }
    </script>
@endpush
