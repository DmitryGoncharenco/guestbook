<div class="container">
    <h1 class="mt-4 mb-3">Сообщения</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/messages" method="post">
                <?php if(isset($_SESSION['account'])): ?>
                <div class="control-group form-group">
                    <div class="controls">
                        <textarea name="content" cols="40px" rows="5px" class="form-control"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
                <?php else: ?>
                <label>Чтобы отправлять сообщения <a href="account/login"> войдите </a>
                 или <a href="account/register"> зарегистрируйтесь</a>.
                </label>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
