@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <a href="{{ route('users.create') }}" class="btn btn-primary my-3">New User</a>

            <table class="table">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Roles</td>
                        <td>&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td></td>
                            <td>
                                <div class="btn-group float-right">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('users.edit', $user) }}">Edit</a>
                                        <a class="dropdown-item delete-resource" href="{{ route('users.destroy', $user) }}">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">There is no data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@section('modals')
<div class="modal fade" id="modal-delete-confirmation" tabindex="-1" role="dialog" aria-labelledby="modal-delete-confirmation" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="form-delete" action="" method="POST">
                    @csrf
                    @method('delete')
                    <strong class="d-block my-5">Are you sure want to delete this?</strong>
                    <div class="float-right">
                        <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, delete it</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$('body').on('click', 'a.delete-resource', function (e) {
    e.preventDefault();
    var button = $(this);
    var href = button.attr('href');
    var modal = $('#modal-delete-confirmation');
    var form = $('#form-delete');
    form.attr('action', href);
    modal.modal({
        show: true,
        keyboard: false,
        backdrop: 'static'
    });
});
</script>
@endsection
