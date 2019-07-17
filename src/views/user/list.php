<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <? print($list);?>
            <?php if (empty($list)): ?>
                <p>Not found list users.</p>
            <?php else: ?>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Create at</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $val): ?>
                        <tr>
                            <th scope="row"><?= $val['id']; ?></th>
                            <td><?= htmlspecialchars($val['username'], ENT_QUOTES); ?></td>
                            <td><?= htmlspecialchars($val['email'], ENT_QUOTES); ?></td>
                            <td><?= htmlspecialchars($val['create_at'], ENT_QUOTES); ?></td>
                            <td><a href="/user/edit/<?= $val['id']; ?>" class="btn btn-primary a-btn-slide-text">
                                    <span class="glyphicon glyphicon-cog" aria-hidden="true">Edit</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <?php echo $pagination; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>