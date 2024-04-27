<?php include __DIR__ . '/header.php'; ?>

<div class="container mt-3">
  <div class="row mt-3 justify-content-around">
    <div class="col-md-8">
      <h1 class="text-center">Search Movies or Series</h1>
      <form action="index.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Movies or Series Title..." id="search-input" name="keyword">
          <div class="input-group-append">
            <button class="btn btn-dark" type="submit" name="cari" id="search-button">Search</button>
          </div>

        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 text-right">
      MOVIES_SORT
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <h3>Movies</h3>
    </div>
  </div>
  <hr>

  <div class="row">
    DATA_MOVIES
  </div>


  <div class="row">
    <div class="col-md-6">
      <h3>Series</h3>
    </div>
  </div>
  <hr>

  <div class="row">
    DATA_SERIES
  </div>

</div>

<?php include __DIR__ . '/footer.php'; ?>