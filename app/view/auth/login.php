<h1>Login</h1>
<?php if(!empty($data)): ?>
    <?php if (isset($data['danger'])): ?>
        <div class="alert alert-danger">
            <?= $data['danger'] ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
<form action="/auth/login" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>