<?php if (empty($data)): ?>
    <p>Not found user.</p>
<?php else: ?>
    <div class="container">
        <form action="/user/edit/<?= $data['id'] ?>" name="form" method="post">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm">
                    <input type="text" class="form-control" id="name" name="username" value="<?= $data['username'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm">
                    <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm">
                    <a href="/user/password/edit/user=<?= $data['id'] ?>">
                        <button type="button" class="btn btn-primary" value="Change password">Change password</button>
                    </a>
                </div>
                <div class="col-lg">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>


<?php endif; ?>