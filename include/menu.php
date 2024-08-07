<?php

session_start();
// hide all error
error_reporting(0);

if (!isset($_SESSION["mikhmon"])) {
  header("Location:../admin.php?id=login");
} else {

  include ('./include/version.php');

  $btnmenuactive = "font-weight: bold;background-color: #f9f9f9; color: #000000";
  if ($hotspot == "dashboard" || substr(end(explode("/", $url)), 0, 8) == "?session") {
    $shome = "active";
    $mpage = $_dashboard;
  } elseif ($hotspot == "quick-print" || $hotspot == "list-quick-print") {
    $squick = "active";
    $mpage = $_quick_print;   
  } elseif ($hotspot == "users" || $userbyprofile != "" || $hotspot == "export-users" || $removehotspotuserbycomment != "" || $removehotspotuser != "" || $removehotspotusers != "" || $disablehotspotuser || $enablehotspotuser != "") {
    $susersl = "active";
    $susers = "active";
    $mpage = $_users;
    $umenu = "menu-open";
  } elseif ($hotspotuser == "add") {
    $sadduser = "active";
    $mpage = $_users;
    $susers = "active";
    $umenu = "menu-open";
  } elseif ($hotspotuser == "generate") {
    $sgenuser = "active";
    $mpage = $_users;
    $susers = "active";
    $umenu = "menu-open";
  } elseif ($userbyname != ""  || $resethotspotuser != "") {
    $susers = "active";
    $mpage = $_users;
    $umenu = "menu-open";
  } elseif ($hotspot == "user-profiles") {
    $suserprofiles = "active";
    $suserprof = "active";
    $mpage = $_user_profile;
    $upmenu = "menu-open";
  } elseif ($hotspot == "active" || $removeuseractive != "") {
    $sactive = "active";
    $mpage = $_hotspot_active;
    $hamenu = "menu-open";
  } elseif ($hotspot == "hosts" || $hotspot == "hostp" || $hotspot == "hosta" || $removehost != "") {
    $shosts = "active";
    $mpage = $_hosts;
    $hmenu = "menu-open";
  } elseif ($hotspot == "dhcp-leases") {
    $slease = "active";
    $mpage = $_dhcp_leases;
  } elseif ($minterface == "traffic-monitor") {
    $strafficmonitor = "active";
    $mpage = $_traffic_monitor;  
  } elseif ($hotspot == "ipbinding" || $hotspot == "binding" || $removeipbinding != "" || $enableipbinding != "" || $disableipbinding != "") {
    $sipbind = "active";
    $mpage = $_ip_bindings;
    $ibmenu = "menu-open";
  } elseif ($hotspot == "template-editor") {
    $ssett = "active";
    $teditor = "active";
    $mpage = $_template_editor;
    $settmenu = "menu-open";
  } elseif ($hotspot == "uplogo") {
    $ssett = "active";
    $uplogo = "active";
    $mpage = $_upload_logo;
    $settmenu = "menu-open";
  } elseif ($hotspot == "cookies" || $removecookie != "") {
    $scookies = "active";
    $mpage = $_hotspot_cookies;
    $cmenu = "menu-open";
  } elseif ($hotspot == "log") {
    $log = "active";
    $slog = "active";
    $mpage = $_hotspot_log;
    $lmenu = "menu-open";
  } elseif ($report == "userlog") {
    $log = "active";
    $sulog = "active";
    $mpage = $_user_log;
    $lmenu = "menu-open";
  } elseif ($ppp == "secrets" || $ppp == "addsecret" || $enablesecr != "" || $disablesecr != "" || $removesecr != "" || $secretbyname != "") {
    $mppp = "active";
    $ssecrets = "active";
    $mpage = $_ppp_secrets;
    $pppmenu = "menu-open";
  } elseif ($ppp == "profiles" || $removepprofile != "" || $ppp == "add-profile" || $ppp == "edit-profile"  ) {
    $mppp = "active";
    $spprofile = "active";
    $mpage = $_ppp_profiles;
    $pppmenu = "menu-open";
  } elseif ($ppp == "active" || $removepactive != "") {
    $mppp = "active";
    $spactive = "active";
    $mpage = $_ppp_active;
    $pppmenu = "menu-open";
  } elseif ($sys == "scheduler" || $enablesch != "" || $disablesch != "" || $removesch != "") {
    $sysmenu = "active";
    $ssch = "active";
    $mpage = $_system_scheduler;
    $schmenu = "menu-open";
  } elseif ($report == "selling" || $report == "resume-report") {
    $sselling = "active";
    $mpage = $_report;
  } elseif ($userprofile == "add") {
    $suserprof = "active";
    $sadduserprof = "active";
    $mpage = $_user_profile;
    $upmenu = "menu-open";
  } elseif ($userprofilebyname != "") {
    $suserprof = "active";
    $mpage = $_user_profile;
    $upmenu = "menu-open";
  } elseif ($hotspot == "users-by-profile") {
    $susersbp = "active";
    $mpage = $_vouchers;
  } elseif ($userbyname != "") {
    $mpage = $_users;
    $susers = "active";
  } elseif ($hotspot == "about") {
    $mpage = $_about;
    $sabout = "active";
  } elseif ($id == "sessions" || $id == "remove" || $router == "new") {
    $ssesslist = "active";
    $mpage = $_admin_settings;
  } elseif ($id == "settings" && $session == "new") {
    $snsettings = "active";
    $mpage = $_add_router;
  } elseif ($id == "settings" || $id == "connect") {
    $ssettings = "active";
    $mpage = $_session_settings;
  } elseif ($id == "about") {
    $sabout = "active";
    $mpage = $_about;
  } elseif ($id == "uplogo") {
    $suplogo = "active";
    $mpage = $_upload_logo;
  } elseif ($id == "editor") {
    $seditor = "active";
    $mpage = $_template_editor;
  }
}

if($idleto != "disable"){
  $didleto = 'display:block;';
}else{
  $didleto = 'display:none;';
}
?>
<span style="display:none;" id="idto"><?= $idleto ;?></span>


<?php if ($id != "") { ?>

<div id="navbar" class="navbar">
  <div class="navbar-left">
    <a id="brand" class="text-center" href="javascript:void(0)" style="visibility:hidden;">MIKHMON</a>

    <a id="openNav" class="navbar-hover" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
    <a id="closeNav" class="navbar-hover" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
    <a id="cpage" class="navbar-left" href="javascript:void(0)"><?= $mpage; ?></a>
  </div>
  <div class="navbar-right">
    <a id="logout" href="./admin.php?id=logout"><i class="fa fa-sign-out mr-1"></i> <?= $_logout ?></a>
  </div>
</div>

<div id="sidenav" class="sidenav">
  <?php if (($id == "settings" && $session == "new") || $id == "settings" && $router == "new") {
}else if ($id == "settings" || $id == "editor"|| $id == "uplogo" || $id == "connect"){
?>
  <div class="menu text-center align-middle card-header" style="border-radius:0;">
    <h3 id="SistemaSession"><?= $session; ?></h3>
  </div>
  <a class="connect menu <?= $shome; ?>" id="<?= $session; ?>&c=settings"><i class='fa fa-tachometer'></i>
    <?= $_dashboard ?></a>
  <a href="./admin.php?id=settings&session=<?= $session; ?>" class="menu <?= $ssettings; ?>" title="Sistema Settings"><i
      class='fa fa-gear'></i> <?= $_session_settings ?></a>
  <div class="menu spa"></div>
  <?php 
} ?>
  <a href="./admin.php?id=sessions" class="menu <?= $ssesslist; ?>"><i class="fa fa-gear"></i>
    <?= $_admin_settings ?></a>
  <a href="./admin.php?id=settings&router=new-<?= rand(1111,9999) ?>" class="menu <?= $snsettings ?>"><i
      class="fa fa-plus"></i> <?= $_add_router ?></a>

</div>

<script>
$(document).ready(function() {
  $(".connect").click(function() {
    notify("<?= $_connecting ?>");
    connect(this.id)
  });
  $(".stheme").change(function() {
    notify("<?= $_loading_theme ?>");
    stheme(this.value)
  });
  $(".slang").change(function() {
    notify("<?= $_loading ?>");
    stheme(this.value)
  });
});
</script>
<div id="notify">
  <div class="message"></div>
</div>
<div id="temp"></div>
<?php 
include('./info.php');
} else { ?>

<div id="navbar" class="navbar">
  <div class="navbar-left">
    <a id="brand" class="text-center" href="./?session=<?= $session; ?>">Sistema</a>

    <a id="openNav" class="navbar-hover" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
    <a id="closeNav" class="navbar-hover" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
    <a id="cpage" class="navbar-left" href="javascript:void(0)"><?= $mpage; ?></a>
  </div>
  <div class="navbar-right">
    <a id="logout" href="./?hotspot=logout&session=<?= $session; ?>"><i class="fa fa-sign-out mr-1"></i>
      <?= $_logout ?></a>
  </div>
</div>

<div id="sidenav" class="sidenav">
  <div class="menu text-center align-middle card-header" style="border-radius:0;">
    <h3><?= $identity; ?></h3>
  </div>
  <a href="./?session=<?= $session; ?>" class="menu <?= $shome; ?>"><i class="fa fa-dashboard"></i>
    <?= $_dashboard ?></a>
  <!--hotspot-->
  <div class="dropdown-btn <?= $susers . $suserprof . $sactive . $shosts . $sipbind . $scookies; ?>"><i
      class="fa fa-wifi"></i> Hotspot
    <i class="fa fa-caret-down"></i>
  </div>
  <div class="dropdown-container <?= $umenu . $upmenu . $hamenu . $hmenu . $ibmenu . $cmenu; ?>">
    <!--users-->
    <div class="dropdown-btn <?= $susers; ?>"><i class="fa fa-users"></i> <?= $_users ?>
      <i class="fa fa-caret-down"></i>
    </div>
    <div class="dropdown-container <?= $umenu; ?>">
      <a href="./?hotspot=users&profile=all&session=<?= $session; ?>" class="<?= $susersl; ?>"> &nbsp;&nbsp;&nbsp;<i
          class="fa fa-list "></i> <?= $_user_list ?> </a>
      <a href="./?hotspot-user=add&session=<?= $session; ?>" class="<?= $sadduser; ?>"> &nbsp;&nbsp;&nbsp;<i
          class="fa fa-user-plus "></i> <?= $_add_user ?> </a>
    </div>
    <!--profile-->
    <div class="dropdown-btn <?= $suserprof; ?>"><i class=" fa fa-pie-chart"></i> <?= $_user_profile ?>
      <i class="fa fa-caret-down"></i>
    </div>
    <div class="dropdown-container <?= $upmenu; ?>">
      <a href="./?hotspot=user-profiles&session=<?= $session; ?>" class=" <?= $suserprofiles; ?>"> &nbsp;&nbsp;&nbsp;<i
          class="fa fa-list "></i> <?= $_user_profile_list ?> </a>
      <a href="./?user-profile=add&session=<?= $session; ?>" class=" <?= $sadduserprof; ?>"> &nbsp;&nbsp;&nbsp;<i
          class="fa fa-plus-square "></i> <?= $_add_user_profile ?> </a>

    </div>
  </div>
  <!--system-->
  <div class="dropdown-btn <?= $sysmenu; ?>"><i class=" fa fa-gear"></i> <?= $_system ?>
    <i class="fa fa-caret-down"></i> &nbsp;
  </div>
  <div class="dropdown-container <?= $schmenu; ?>">
    <a href="./admin.php?id=reboot&session=<?= $session; ?>" class=""> <i class="fa fa-power-off "></i>
      <?= $_system_reboot ?> </a>
    <a href="./admin.php?id=shutdown&session=<?= $session; ?>" class=""> <i class="fa fa-power-off "></i>
      <?= $_system_off ?> </a>
  </div>
  <!--settings-->
  <div class="dropdown-btn <?= $ssett; ?>"><i class=" fa fa-gear"></i> <?= $_settings ?>
    <i class="fa fa-caret-down"></i> &nbsp;
  </div>
  <div class="dropdown-container <?= $settmenu; ?>">
    <a href="./admin.php?id=settings&session=<?= $session; ?>" class="menu "> <i class="fa fa-gear "></i>
      <?= $_session_settings ?> </a>
    <a href="./admin.php?id=sessions" class="menu "> <i class="fa fa-gear "></i> <?= $_admin_settings ?> </a>
  </div>

</div>
<script>
$(document).ready(function() {
  $(".connect").change(function() {
    notify("<?= $_connecting ?>");
    connect(this.value)
  });
  $(".stheme").change(function() {
    notify("<?= $_loading_theme ?>");
    stheme(this.value)
  });
});
</script>
<div id="notify">
  <div class="message"></div>
</div>
<div id="temp"></div>
<?php 
include('./include/info.php');
} ?>

<div id="main">
  <div id="loading" class="lds-dual-ring"></div>
  <?php if($hotspot == 'template-editor' || $id == 'editor'){
echo '<div class="main-container">';
}else{
  echo '<div class="main-container" style="display:none">';
}
?>