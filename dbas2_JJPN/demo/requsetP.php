<form action="index.php" method="GET">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-danger">Request Product ID</label>
        <input type="text" name="pid" class="form-control">
        <div class="form-text"></div>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Sender ID </label>
        <input type="text" name="s" class="form-control">
        <div class="form-text">Warehouse ID = 1 || Branch Store 1 ID = 2 || Branch Store 2 ID = 3</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">to Destination ID </label>
        <input type="text" name="d" class="form-control">
        <div class="form-text">Warehouse ID = 1 || Branch Store 1 ID = 2 || Branch Store 2 ID = 3</div>
    </div>

    <button class='w-100 mb-2 mt-2 btn btn-lg rounded-4 btn-warning nav-color' type='submit' name='action' value='request'>Request product</button>
</form>