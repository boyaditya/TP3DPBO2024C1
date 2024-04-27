<?php include __DIR__ . '/header.php'; ?>

<div class="container">
  <div class="row mt-3 justify-content-around">
    <div class="col-md-8">
      <h1 class="text-center">Search ITEM</h1>
      <form action="ACTION_FILE" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="ITEM Title..." id="search-input" name="keyword">
          <div class="input-group-append">
            <button class="btn btn-dark" type="submit" name="cari" id="search-button">Search</button>
          </div>

        </div>
      </form>
    </div>
  </div>

<div class="row">
    <div class="col-md-6">
        <h3>ITEM</h3>
    </div>
    <div class="col-md-6 text-right">
        BUTTON_ADD
    </div>
</div>
  
  <hr>
  <div class="row">
    DATA_ITEM
  </div>

</div>

<?php include __DIR__ . '/footer.php'; ?>