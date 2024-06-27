
@auth
    @extends('layouts.navbar')
    @section('title',"Yönetici")
    @section('username',auth()->user()->username)
    @section('role',auth()->user()->roles->first()->name)
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
    <div class="content">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="input1" class="form-label">Input 1</label>
                        <input type="text" class="form-control" id="input1">
                    </div>
                    <div class="mb-3">
                        <label for="input2" class="form-label">Input 2</label>
                        <input type="text" class="form-control" id="input2">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

