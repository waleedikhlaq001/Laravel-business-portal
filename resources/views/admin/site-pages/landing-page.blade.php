@extends('admin.app')
@section('content')
@include('includes.messages');
<div class="container-fluid">
    <h1>Home Page</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-uppercase">Main Section</div>
                <form action="{{route('admin.site.landing.main')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="main_header">Main header</label>
                            <input type="hidden" name="id" value="{{$main_content->id}}">
                            <input type="text" name="main_header" id=""
                                class="form-control @error('main_header') is-invalid @enderror"
                                value="{{$main_content->main_header}}">
                            @error('main_header')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="main_description">Main description</label>
                            <input type="text" name="main_description" id=""
                                class="form-control @error('main_description') is-invalid @enderror"
                                value="{{$main_content->main_description}}">
                            @error('main_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between">
                    <h6 class="text-uppercase">Why Vicomma is for you</h6>
                    {{-- <h6 class="ml-auto p-2 bg-primary">Hire a creative</h6> --}}
                </div>
                <form action="{{route('admin.site.why-vicomma')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$why_vicomma->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Hire a creative</label>
                            <input type="text" name="hire_creative" id=""
                                class="form-control @error('hire_creative') is-invalid @enderror"
                                value="{{$why_vicomma->hire_creative}}">
                            @error('hire_creative')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="hire_creative_description" id=""
                                class="form-control @error('hire_creative_description') is-invalid @enderror"
                                value="{{$why_vicomma->hire_creative_description}}">
                            @error('hire_creative_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        {{-- Earn money --}}
                        <div class="form-group">
                            <label for="">Earn Money Creating</label>
                            <input type="text" name="earm_money" id=""
                                class="form-control @error('earm_money') is-invalid @enderror"
                                value="{{$why_vicomma->earm_money}}">
                            @error('earm_money')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="earm_money_description" id=""
                                class="form-control @error('earm_money_description') is-invalid @enderror"
                                value="{{$why_vicomma->earm_money_description}}">
                            @error('earm_money_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        {{--  --}}
                        <div class="form-group">
                            <label for="">Watch and Buy</label>
                            <input type="text" name="watch_buy" id=""
                                class="form-control @error('watch_buy') is-invalid @enderror"
                                value="{{$why_vicomma->watch_buy}}">
                            @error('watch_buy')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="watch_buy_description" id=""
                                class="form-control @error('watch_buy_description') is-invalid @enderror"
                                value="{{$why_vicomma->watch_buy_description}}">
                            @error('watch_buy_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        {{--  --}}
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-uppercase">Not just another video sharing plateform</div>
                <form action="{{route('admin.site.platform')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$not_just_platform->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Not just another video sharing platform</label>
                            <input type="text" name="not_just_platform" id=""
                                class="form-control @error('not_just_platform') is-invalid @enderror"
                                value="{{$not_just_platform->not_just_another_platform}}">
                            @error('not_just_platform')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea
                                class="form-control @error('not_just_another_platform_description') is-invalid @enderror"
                                name="not_just_another_platform_description" id="" cols="30"
                                rows="5">{{$not_just_platform->not_just_another_platform_description}}</textarea>
                            @error('not_just_another_platform_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">The Vicom icon</label>
                            <input type="text" name="vcomm_icon" id=""
                                class="form-control @error('vcomm_icon') is-invalid @enderror"
                                value="{{$not_just_platform->vcomm_icon}}">
                            @error('vcomm_icon')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control @error('vcomm_icon_description') is-invalid @enderror"
                                name="vcomm_icon_description" id="" cols="30"
                                rows="5">{{$not_just_platform->vcomm_icon_description}}</textarea>
                            @error('vcomm_icon_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header text-uppercase">why join vicomma</div>
                <form action="{{route('admin.site.why-join-vicomma')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$why_join_vicomma->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">why join vicomma</label>
                            <textarea name="why_join_vicomma_description" id="" cols="30" rows="4"
                                class="form-control @error('why_join_vicomma_description') is-invalid @enderror">{{$why_join_vicomma->why_join_vicomma_description}}</textarea>
                            @error('why_join_vicomma_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-uppercase">How does vcomma work?</div>
                <form action="{{route('admin.site.how-vicomma-works')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$how_vicomma_works->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Step 1</label>
                            <input type="text" name="step1_header"
                                class="form-control @error('step1_header') is-invalid @enderror"
                                value="{{$how_vicomma_works->step1_header}}">
                            @error('step1_header')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Step 1 description</label>
                            <textarea name="step1_description" id="" cols="30" rows="5"
                                class="form-control @error('step1_description') is-invalid @enderror">{{$how_vicomma_works->step1_description}}</textarea>
                            @error('step1_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Step 2</label>
                            <input type="text" name="step2_header"
                                class="form-control @error('step2_header') is-invalid @enderror"
                                value="{{$how_vicomma_works->step2_header}}">
                            @error('step2_header')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Step 2 description</label>
                            <textarea name="step2_description" id="" cols="30" rows="5"
                                class="form-control @error('step2_description') is-invalid @enderror">{{$how_vicomma_works->step2_description}}</textarea>
                            @error('step2_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Step 3</label>
                            <input type="text" name="step3_header"
                                class="form-control @error('step3_header') is-invalid @enderror"
                                value="{{$how_vicomma_works->step3_header}}">
                            @error('step3_header')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Step 3 description</label>
                            <textarea name="step3_description" id="" cols="30" rows="5"
                                class="form-control @error('step3_description') is-invalid @enderror">{{$how_vicomma_works->step3_description}}</textarea>
                            @error('step3_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Step 4</label>
                            <input type="text" name="step4_header"
                                class="form-control @error('step4_header') is-invalid @enderror"
                                value="{{$how_vicomma_works->step4_header}}">
                            @error('step4_header')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Step 4 description</label>
                            <textarea name="step4_description" id="" cols="30" rows="5"
                                class="form-control @error('step4_description') is-invalid @enderror">{{$how_vicomma_works->step4_description}}</textarea>
                            @error('step4_description')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection