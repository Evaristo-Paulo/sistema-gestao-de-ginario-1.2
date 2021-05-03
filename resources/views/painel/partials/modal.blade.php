<!-- ALTERAR SENHA -->
<div class="col-lg-6 mt-5">
    <div class="card">
        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="user-modal-altera-senha">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User - Alterar Senha</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form action="{{ route('user.change.password') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">
                                        Email <span class="required">*</span></label>
                                    <input class="form-control" required type="email"
                                        value="{{ old('email') }}" name="email" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">
                                        Senha <span class="required">*</span></label>
                                    <input class="form-control" minlength="6" required type="password" id="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="password-same" class="col-form-label">
                                        Confirma Senha <span class="required">*</span></label>
                                    <input class="form-control" minlength="6" required type="password" id="password-same" name="password-same">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ALTERAR FOTO -->
<div class="col-lg-6 mt-5">
    <div class="card">
        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="worker-modal-altera-foto">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Funcionário - Alterar Foto</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form action="{{ route('worker.change.photo') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">
                                        Email <span class="required">*</span></label>
                                    <input class="form-control" required type="email"
                                        value="{{ old('email') }}" name="email" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="col-form-label">
                                        Foto <span class="required">*</span></label>
                                    <input type="file" id="photo" name="photo" required class="form-control "
                                        value="{{ old('photo') }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
