<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                        <div class="card-body">
                            <form action="/account/register" method="post">
                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">
                                        Name
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_name" class="form-control" name="username"
                                               required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail
                                        Address</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email_address" class="form-control" name="email"
                                               required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                        password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password-confirm" class="form-control" name="confirmpassword" required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>