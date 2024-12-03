@extends('layouts.dashboard.app')

@section('title')
    Admin
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.admins') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.admins.index') }}">{{ __('dashboard.admins') }}</a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
                @include('dashboard.includes.button-header')
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.admins') }} </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <a href="{{ route('dashboard.admins.create') }}"
                                class="btn btn-danger">{{ __('dashboard.add') }}</a><br><br>

                            {{-- <input name="ajax_search_value" id="ajax_search" placeholder="Search here ...."
                                class="form-control"><br><br>

                            <div class="ajax_table"> --}}

                                <table class="table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('dashboard.name') }}</th>
                                            <th scope="col">{{ __('dashboard.email') }} </th>
                                            <th scope="col">{{ __('dashboard.role') }} </th>
                                            <th scope="col">{{ __('dashboard.status') }} </th>
                                            <th scope="col">{{ __('dashboard.created_at') }} </th>
                                            <th scope="col">{{ __('dashboard.operations') }} </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($admins as $admin)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $admin->name }} </td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->role->role }}</td>
                                                <td>{{ $admin->status }}</td>
                                                <td>{{ $admin->created_at->format('Y-m-d h:m a') }}</td>

                                                <td>
                                                    <div class="dropdown float-md-left">
                                                        <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                            id="dropdownBreadcrumbButton" type="button"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">{{ __('dashboard.operations') }}</button>
                                                        <div class="dropdown-menu"
                                                            aria-labelledby="dropdownBreadcrumbButton">

                                                            {{-- edit --}}
                                                            <a class="dropdown-item"
                                                                href="{{ route('dashboard.admins.edit', $admin->id) }}"><i
                                                                    class="la la-edit"></i>{{ __('dashboard.edit') }}</a>

                                                            {{-- changeStatus --}}
                                                            <a class="dropdown-item"
                                                                href="{{ route('dashboard.admins.changeStatus', $admin->id) }}"><i
                                                                    class="la @if ($admin->status == 'Active') la-toggle-on @else la-toggle-off @endif"></i>
                                                                @if ($admin->status == 'Active')
                                                                    {{'Desactive' }}
                                                                @else
                                                                    {{ 'Active' }}
                                                                @endif
                                                            </a>

                                                            {{-- delete --}}
                                                            <div class="dropdown-divider"></div><a class="dropdown-item"
                                                                href="javascript:void(0)"
                                                                onclick="if(confirm('Are you sure you want to delete this admin?')){document.getElementById('delete-form-{{ $admin->id }}').submit();} return false"><i
                                                                    class="la la-trash"></i>
                                                                {{ __('dashboard.delete') }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                            {{-- delete form  --}}
                                            <form id="delete-form-{{ $admin->id }}"
                                                action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>


                                        @empty
                                            <td colspan="4"> No Data</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- {{ $admins->links() }} --}}
                            {{ $admins->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('js')
    <script>
        let debounce

        $(document).on('input', '#ajax_search', function(e) {
            e.preventDefault();

            var ajax_search_value = $(this).val();

            clearTimeout(debounce)
            debounce = setTimeout(() => {
                $.ajax({
                    url: "{{ route('admins.searchByAjax') }}",
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'ajax_search_value': ajax_search_value,
                    },

                    success: function(data) {
                        $('.ajax_table').html(data)
                    },
                });
            }, 2000); // 2 seconde
        });
    </script>
@endpush --}}
