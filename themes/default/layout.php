<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Apirus - Example</title>
    <style type="text/css">
      .navbar {
        z-index: 2;
      }
      .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        padding: 70px 0 0;
        width: 250px;
        background: #fff;
        font-size: 13px;
        border-right: 1px solid #eee;
      }
      .sidebar h3 {
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        padding: .2rem 1rem;
        margin-bottom: 0;
        margin-top: 1rem;
      }
      .sidebar .nav-link {
        padding: .25rem .5rem;
        margin: 0 .5rem;
        color: #212529;
        border-radius: 3px;
      }
      .sidebar .nav-link:hover {
        background: rgba(0,0,0,.05);
      }
      .sidebar .nav-link .badge {
        width: 32px;
        font-size: 8px;
        line-height: 1;
      }
      .main {
        padding-left: 250px;
        margin-top: 56px;
      }
      .section-header {
        padding: 20px;
        border-right: 1px solid #eee;
      }
      .section-http .section-url {
        border-top: 1px solid #eee;
        margin-left: -15px;
        margin-right: -15px;
        padding: 10px 20px;
        color: #999;
      }
      .section-http .section-request {
        background: #444;
        padding: 0;
      }
      .section-http .nav-link {
        font-size: 14px;
        border-radius: 0;
        padding: .3rem 1rem;
      }
      .section-http .section-request .nav {
        background: #393939;
      }
      .section-http .section-request .nav .nav-link {
        color: #bbb;
      }
      .section-http .section-request .nav .nav-link.active {
        color: #fff;
        background: none;
      }
      .section-http .section-response {
        background: #393939;
        padding: 0;
      }
      .section-http .section-response .nav {
        background: #313131;
      }
      .section-http .section-response .nav .nav-link {
        color: #fff;
      }
      .section-http .section-response .nav .nav-link.active {
        background: #282828;
      }
      .section-http .tab-pane {
        padding: 20px;
      }
      .section-http .tab-pane pre {
        color: #ddd;
      }
      @media (max-width: 991px) {
        .sidebar {
          width: 200px;
        }
        .main {
          padding-left: 200px;
        }
      }
      @media (max-width: 767px) {
        .sidebar {
          display: none;
        }
        .main {
          padding-left: 0;
        }
      }
    </style>
  </head>
  <body>
    <header>
      <!-- menu header -->
      <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Apirus</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">GitHub</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- menu sidebar -->
    <nav class="sidebar">
    <?php foreach ($menu as $item): ?>
      <div class="sidebar-section">
        <!-- menu title -->
        <h3><?= $item['title'] ?></h3>
        <ul class="nav flex-column">
          <?php foreach ($item['submenu'] as $subitem): ?>
          <!-- menu item -->
          <li class="nav-item">
            <a class="nav-link active" href="#<?= $subitem['slug'] ?>">
              <?php if ($subitem['method']): ?>
              <span class="badge badge-warning"><?= $subitem['method'] ?></span>
              <?php endif ?>
              <?= $subitem['title'] ?>
            </a>
          </li>
          <?php endforeach ?>
        </ul>
      </div>
      <?php endforeach ?>
    </nav>
    <!-- main -->
    <main class="main">
      <div class="container-fluid">
        <?php foreach ($items as $section): ?>
        <a id="<?= $section['slug'] ?>"></a>
        <section class="section">
          <!-- header and description -->
          <div class="row">
            <header class="section-header col-lg-8 col-md-6">
              <h2><?= $section['meta']['title'] ?></h2>
              <div class="description">
                <?= $section['content'] ?>
              </div>
            </header>
          </div>
          <div class="section-http">
            <!-- request method and url -->
            <?php if (isset($section['meta']['method']) && isset($section['meta']['url'])): ?>
            <div class="section-url">
              <span class="badge badge-primary mr-2"><?= $section['meta']['method'] ?></span>
              <?= $section['meta']['url'] ?>
            </div>
            <?php endif ?>

            <div class="row">
              <div class="section-request col-lg-8 col-md-6">
                <ul class="nav nav-pills" role="tablist">
                  <!-- request tab -->
                  <?php foreach ($section['requests'] as $request): ?>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $request['first'] ? 'active' : '' ?>" data-toggle="pill" href="#<?= $request['hash'] ?>"><?= $request['lang'] ?></a>
                  </li>
                  <?php endforeach ?>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <!-- request body -->
                  <?php foreach ($section['requests'] as $request): ?>
                  <div class="tab-pane fade show <?= $request['first'] ? 'active' : '' ?>" id="<?= $request['hash'] ?>">
                    <?= $request['body'] ?>
                  </div>
                  <?php endforeach ?>
                </div>
              </div>
              <div class="section-response col-lg-4 col-md-6">
                <ul class="nav nav-pills" role="tablist">
                  <!-- response tab -->
                  <?php foreach ($section['responses'] as $response): ?>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $response['first'] ? 'active' : '' ?>" data-toggle="pill" href="#<?= $response['hash'] ?>">
                      <?= $response['code'] ?>
                    </a>
                  </li>
                  <?php endforeach ?>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <!-- response body -->
                  <?php foreach ($section['responses'] as $response): ?>
                  <div class="tab-pane fade show <?= $response['first'] ? 'active' : '' ?>" id="<?= $response['hash'] ?>">
                    <?= $response['body'] ?>
                  </div>
                  <?php endforeach ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php endforeach ?>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>
</html>