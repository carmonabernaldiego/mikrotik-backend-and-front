<?php

session_start();
// hide all error
error_reporting(0);
if (!isset($_SESSION["mikhmon"])) {
  header("Location:../admin.php?id=login");
} else {
// load session MikroTik
  $session = $_GET['session'];
  $load = $_GET['load'];

// lang
include('../include/lang.php');
include('../lang/'.$langid.'.php');

// load config
  include('../include/config.php');
  include('../include/readcfg.php');

// routeros api
  include_once('../lib/routeros_api.class.php');
  include_once('../lib/formatbytesbites.php');
  $API = new RouterosAPI();
  $API->debug = false;



  if ($load == "sysresource") {

    $API->connect($iphost, $userhost, decrypt($passwdhost));

// get MikroTik system clock
    $getclock = $API->comm("/system/clock/print");
    $clock = $getclock[0];
    $timezone = $getclock[0]['time-zone-name'];
    date_default_timezone_set($timezone);

// get system resource MikroTik
    $getresource = $API->comm("/system/resource/print");
    $resource = $getresource[0];

// get routeboard info
    $getrouterboard = $API->comm("/system/routerboard/print");
    $routerboard = $getrouterboard[0];
    ?>

<div id="r_1" class="row">
  <div class="col-6">
    <div class="box bmh-75 box-bordered">
      <div class="box-group">
        <div class="box-group-icon"><i class="fa fa-info-circle"></i></div>
        <div class="box-group-area">
          <span>
            <?php
                    echo $_board_name." : " . $resource['board-name'] . "<br/>
                    ".$_model." : " . $routerboard['model'] . "<br/>
                    Router OS : " . $resource['version'];
                    ?>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="box bmh-75 box-bordered">
      <div class="box-group">
        <div class="box-group-icon"><i class="fa fa-server"></i></div>
        <div class="box-group-area">
          <span>
            <?php
                    echo $_cpu_load." : " . $resource['cpu-load'] . "%<br/>
                    ".$_free_memory." : " . formatBytes($resource['free-memory'], 2) . "<br/>
                    ".$_free_hdd." : " . formatBytes($resource['free-hdd-space'], 2)
                    ?>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
} else if ($load == "hotspot") {

  $API->connect($iphost, $userhost, decrypt($passwdhost));
// get & counting hotspot users
  $countallusers = $API->comm("/ip/hotspot/user/print", array("count-only" => ""));
  if ($countallusers < 2) {
    $uunit = "item";
  } elseif ($countallusers > 1) {
    $uunit = "items";
  }

// get & counting hotspot active
  $counthotspotactive = $API->comm("/ip/hotspot/active/print", array("count-only" => ""));
  if ($counthotspotactive < 2) {
    $hunit = "item";
  } elseif ($counthotspotactive > 1) {
    $hunit = "items";
  }

  ?>

<div id="r_2" class="card">
  <div class="card-header">
    <h3><i class="fa fa-wifi"></i> Hotspot</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-6 col-box-6">
        <div class="box bg-green bmh-75">
          <a href="./?hotspot=users&profile=all&session=<?= $session; ?>">
            <h1><?= $countallusers; ?>
              <span style="font-size: 15px;"><?= $uunit; ?></span>
            </h1>
            <div>
              <i class="fa fa-users"></i> <?= $_hotspot_users ?>
            </div>
          </a>
        </div>
      </div>
      <div class="col-6 col-box-6">
        <div class="box bg-yellow bmh-75">
          <a href="./?hotspot-user=add&session=<?= $session; ?>">
            <div>
              <h1><i class="fa fa-user-plus"></i>
                <span style="font-size: 15px;"><?= $_add ?></span>
              </h1>
            </div>
            <div>
              <i class="fa fa-user-plus"></i> <?= $_hotspot_users ?>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php 
} else if ($load == "logs") {

  $API->connect($iphost, $userhost, decrypt($passwdhost));

  // move hotspot log to disk
  $getlogging = $API->comm("/system/logging/print", array("?prefix" => "->", ));
  $logging = $getlogging[0];
  if ($logging['prefix'] == "->") {
  } else {
    $API->comm("/system/logging/add", array("action" => "disk", "prefix" => "->", "topics" => "hotspot,info,debug", ));
  }
  
  // get hotspot log
  $getlog = $API->comm("/log/print", array("?topics" => "hotspot,info,debug", ));
  $log = array_reverse($getlog);
  //$THotspotLog = count($getlog);

  if ($livereport == "disable") {
    $logh = "457px";
    $lreport = "style='display:none;'";
  } else {
    $logh = "350px";
    $lreport = "style='display:block;'";
  }



  ?>

<div id="r_3" class="row">
  <div class="card">
    <div class="card-header">
      <h3><a href="./?hotspot=log&session=<?= $session; ?>" title="Open Hotspot Log"><i class="fa fa-align-justify"></i>
          <?= $_hotspot_log ?></a></h3>
    </div>
    <div class="card-body">
      <div style="padding: 5px; height: <?= $logh; ?> ;" class="mr-t-10 overflow">
        <table class="table table-sm table-bordered table-hover" style="font-size: 12px; td.padding:2px;">
          <thead>
            <tr>
              <th><?= $_time .$THotspotLog; ?></th>
              <th><?= $_users ?> (IP)</th>
              <th><?= $_messages ?></th>
            </tr>
          </thead>
          <tbody>

            <?php


  for ($i = 0; $i < 20; $i++) {
    $mess = explode(":", $log[$i]['message']);
    $time = $log[$i]['time'];
    echo "<tr>";
    if (substr($log[$i]['message'], 0, 2) == "->") {
      echo "<td>" . $time . "</td>";
    //echo substr($mess[1], 0,2);
      echo "<td>";
      if (count($mess) > 6) {
        echo $mess[1] . ":" . $mess[2] . ":" . $mess[3] . ":" . $mess[4] . ":" . $mess[5] . ":" . $mess[6];
      } else {
        echo $mess[1];
      }
      echo "</td>";
      echo "<td>";
      if (count($mess) > 6) {
        echo str_replace("trying to", "", $mess[7] . " " . $mess[8] . " " . $mess[9] . " " . $mess[10]);
      } else {
        echo str_replace("trying to", "", $mess[2] . " " . $mess[3] . " " . $mess[4] . " " . $mess[5]);
      }
      echo "</td>";
    } else {
    }
    echo "</tr>";
  }
  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php 
}

}

?>