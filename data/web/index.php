<?php
require_once 'inc/prerequisites.inc.php';

if (isset($_SESSION['mailcow_cc_role']) && $_SESSION['mailcow_cc_role'] == 'admin') {
  header('Location: /admin.php');
  exit();
}
elseif (isset($_SESSION['mailcow_cc_role']) && $_SESSION['mailcow_cc_role'] == 'domainadmin') {
  header('Location: /mailbox.php');
  exit();
}
elseif (isset($_SESSION['mailcow_cc_role']) && $_SESSION['mailcow_cc_role'] == 'user') {
  header('Location: /user.php');
  exit();
}

require_once 'inc/header.inc.php';
$_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
?>
<div class="container">
  <div class="row">
    <div class="col-md-offset-3 col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?= $lang['login']['login']; ?></div>
        <div class="panel-body">
          <div class="text-center mailcow-logo"><img src="<?=($main_logo = customize('get', 'main_logo')) ? $main_logo : '/img/cow_mailcow.svg';?>" alt="mailcow"></div>
          <legend>elaon Mail UI</legend>
            <form method="post" autofill="off">
            <div class="form-group">
              <label class="sr-only" for="login_user"><?= $lang['login']['username']; ?></label>
              <div class="input-group">
                <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
                <input name="login_user" autocorrect="off" autocapitalize="none" type="text" id="login_user" class="form-control" placeholder="<?= $lang['login']['username']; ?>" required="" autofocus="">
              </div>
            </div>
            <div class="form-group">
              <label class="sr-only" for="pass_user"><?= $lang['login']['password']; ?></label>
              <div class="input-group">
                <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
                <input name="pass_user" type="password" id="pass_user" class="form-control" placeholder="<?= $lang['login']['password']; ?>" required="">
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success" value="Login"><?= $lang['login']['login']; ?></button>
            </div>
            </form>
            <?php
            if (isset($_SESSION['ldelay']) && $_SESSION['ldelay'] != '0'):
            ?>
            <p><div class="alert alert-info"><?= sprintf($lang['login']['delayed'], $_SESSION['ldelay']); ?></b></div></p>
            <?php
            endif;
            ?>
          <legend>Apps</legend>
          <?php
          foreach ($MAILCOW_APPS as $app):
          ?>
            <a href="<?= htmlspecialchars($app['link']); ?>" role="button" title="<?= htmlspecialchars($app['description']); ?>" class="btn btn-lg btn-default"><?= htmlspecialchars($app['name']); ?></a>&nbsp;
          <?php
          endforeach;
          $app_links = customize('get', 'app_links');
          foreach ($app_links as $row) {
            foreach ($row as $key => $val):
          ?>
            <a href="<?= htmlspecialchars($val); ?>" role="button" class="btn btn-lg btn-default"><?= htmlspecialchars($key); ?></a>&nbsp;
          <?php
            endforeach;
          }
          ?>
        </div>
      </div>
    </div>
    <div class="col-md-offset-3 col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a data-toggle="collapse" href="#collapse1"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> <?= $lang['start']['help']; ?></a>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
          <div class="panel-body">
            <p><span style="border-bottom: 1px dotted #999;">Elaon Mail UI</span></p>
            <p><?= $lang['start']['mailcow_panel_detail']; ?></p>
            <p><span style="border-bottom: 1px dotted #999;">Apps</span></p>
            <p><?= $lang['start']['mailcow_apps_detail']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- /.container -->
<script src="js/index.js"></script>
<?php
require_once 'inc/footer.inc.php';
