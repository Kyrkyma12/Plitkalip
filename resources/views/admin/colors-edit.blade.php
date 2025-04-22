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
                        <a href="{{ route('admin.color.add') }}">
                            <div class="text-tiny">Colors</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit Color</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.color.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $color->id }}" />
                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Color name" name="name" tabindex="0" value="{{ $color->name }}" aria-required="true" required="">
                    </fieldset>
                    @error('name')
                    <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Color Slug <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="color Slug" name="slug" tabindex="0" value="{{ $color->slug }}" aria-required="true" required="">
                    </fieldset>
                    @error('slug')
                    <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Color Slug <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Color code" name="code" tabindex="0" value="{{ $color->code }}" aria-required="true" required="">
                    </fieldset>
                    @error('code')
                    <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Edit</button>
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
