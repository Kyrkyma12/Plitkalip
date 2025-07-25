@extends('layouts.admin')
@section('content')
        <style>
            .buttonmodal{
                background-color: #40c710;
            }

            .cancelbuttonmodal{
                background-color: #f80404;
            }
        </style>
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>{{__('messages.Sizes')}}</h3>
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
                            <div class="text-tiny">{{__('messages.Sizes')}}</div>
                        </li>
                    </ul>
                </div>

                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <form class="form-search">
                                <fieldset class="name">
                                    <input type="text" placeholder="{{__('messages.Search here...')}}" class="" name="name"
                                           tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <div class="button-submit">
                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.size.add') }}"><i class="icon-plus"></i>{{__('messages.Add new')}}</a>
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            @if(Session::has('status'))
                                <p class="alert alert-success">{{Session::get('status')}}</p>
                            @endif
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>{{__('messages.Number Size')}}</th>
                                    <th>{{__('messages.Name')}}</th>
                                    <th>Slug</th>
                                    <th>{{__('messages.Products')}}</th>
                                    <th>{{__('messages.Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sizes as $size)
                                    <tr>
                                        <td>{{ $size->id }}</td>
                                        <td class="pname">
                                            <div class="name">
                                                <a href="#" class="body-title-2">{{ $size->name }}</a>
                                            </div>
                                        </td>
                                        <td>{{ $size->slug }}</td>
                                        <td>{{ $size->category_id }}</td>
                                        <td><a href="#" target="_blank">1</a></td>
                                        <td>
                                            <div class="list-icon-function">
                                                <a href="{{ route('admin.size.edit', ['id' => $size->id]) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <form action="{{ route('admin.size.delete', ['id'=>$size->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="item text-danger delete">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                            {{ $sizes->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push("scripts")
    <script>
        $(function (){
            $('.delete').on('click',function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons:{
                        cancelar:{
                            text:"No, cancel!",
                            value:false,
                            className:"cancelbuttonmodal",
                        },
                        confirmar:{
                            text:"Yes, delete it!",
                            value:true,
                            className:"buttonmodal"
                        },
                    },
                }).then((result) => {
                    if (result === true){
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
