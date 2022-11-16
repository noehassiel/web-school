@extends('back.layouts.main')

{{-- 
@section('title')
    <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
    </ol>
    <h6 class="font-weight-bold mb-0">Dashboard</h6>
@endsection
 --}}

@section('content')

@if($banners->count() == 0)
<div class="card-body text-center" style="padding:80px 0px 100px 0px;">
    <img src="{{ asset('assets/img/group_7.svg') }}" height="100px" class="wd-20p ml-auto mr-auto mb-5">
    <h4>¡No hay banners guardadas en la base de datos!</h4>
    <p class="mb-4">Empieza a cargar banners en tu plataforma usando el botón superior.</p>
    <a href="{{ route('banners.create') }}" class="btn btn-sm btn-primary btn-uppercase ml-auto mr-auto">Crear nuevo banner</a>
</div>
@else

<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-10">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Imagen</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Información</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Prioridad</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Botón</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Link</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Estatus</th>
                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $banner)
                        <tr>
                            <td style="width: 150px;">
                                <img style="width: 100%;" src="{{ asset('img/banners/' . $banner->image_desktop ) }}" alt="{{ $banner->title }}">
                                
                            </td>
                            <td style="width: 250px;">
                                <strong>{{ $banner->title }}</strong><br>
                                <p>{{ $banner->subtitle }}</p>
                            </td>
                            <td> {{$banner->priority}}</td>
                            <td>{{ $banner->text_button }}</td>
                            <td>{{ $banner->link }}</td>

                            <td>
                                @if($banner->is_active == true)
                                    <span class="badge badge-success">Activado</span><br>
                                @else
                                    <span class="badge badge-info">Desactivado</span><br>
                                @endif
                            </td>
                            
                            <td class="d-flex">
                                <a href="{{ route('banners.show', $banner->id) }}" class="btn btn-link text-dark px-1 py-0" data-toggle="tooltip" data-original-title="Ver Detalle">
                                    <i data-feather="eye"></i>
                                </a>

                                <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-link text-dark px-1 py-0" data-toggle="tooltip" data-original-title="Editar">
                                    <i data-feather="edit"></i>
                                </a>

                                <form method="POST" action="{{ route('banners.status', $banner->id) }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-link text-dark px-1 py-0" data-toggle="tooltip" data-original-title="Cambiar estado">
                                        <i data-feather="trash"></i>
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('banners.destroy', $banner->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-link text-danger px-1 py-0" data-toggle="tooltip" data-original-title="Eliminar Banner">
                                        <i class="fas fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row justify-items-center">
    <div class="col text-center">
        {{ $banners->links() }}
    </div>
</div>
@endif

@endsection