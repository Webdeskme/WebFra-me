<?php
$wd_root = '../../webdesk/www/';
  /*function wd_nav($page, $color, $name, $login, $loc, $register){
    if(file_exists("www/Pages/nav.json")){
      $proot = "index.php?page=";
      $obj = file_get_contents("www/Pages/nav.json");
      $obj = json_decode($obj);
    ?>
<nav class="navbar navbar-<?php if($color == "light"){
      echo "default";
    }
     else{
       echo "inverse";
     }
     if($loc == 'fixed'){ echo ' navbar-fixed-top';} ?>" style="margin: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <?php 
    if($name != ""){
    ?>
      <a class="navbar-brand" href="index.php?page=index.php"><?php echo $name; ?></a>
      <?php 
    }
    ?>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <?php
      $i = 1;
        while($i <= 9){
      foreach($obj as $opage){
        if($opage->par == "np" && $opage->pr == $i){
          $x = 1;
          foreach($obj as $cpage){
            if($cpage->par == $opage->page){
              $x = 2;
            }
        }
    ?>
        <li<?php if($x == 2 && $page == $opage->page || $obj->$page->par == $opage->page){
    echo ' class="dropdown active"';
    }
          else{
          if($x == 2){
      echo  ' class="dropdown"';
    } 
          if($page == $opage->page){echo ' class="active"';}} ?>><a<?php if($x == 2){ echo ' class="dropdown-toggle" data-toggle="dropdown"';} ?> href="<?php if($x == 2){
      echo '#';
    } 
          else{ echo 'index.php?page=' . $opage->page;} ?>"><?php echo $opage->title; if($x == 2){ echo '<span class="caret"></span>';} ?></a>
<?php
          if($x == 2){
           ?>
        <ul class="dropdown-menu">
          <li><a href="<?php echo 'index.php?page=' . $opage->page; ?>"><?php echo $opage->title; ?></a></li>
          <?php
            $z = 1;
        while($z <= 9){
            foreach($obj as $spage){
              if($spage->par == $opage->page && $spage->pr == $z){
            ?>
          <li><a href="<?php echo 'index.php?page=' . $spage->page; ?>"><?php echo $spage->title; ?></a></li>
          <?php
              }
            }
          $z = $z + 1;
        }
            ?>
        </ul>
        <?php
          }
        ?>
        </li>
          <?php
        }
    }
          $i = $i + 1;
        }
    ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
    if($register != ""){
    ?>
        <li<?php if($register == $page){ echo ' class="active"';} ?>><a href="<?php echo $proot . $register; ?>"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <?php
    }
    if($login == "yes"){
    ?>
        <li><a href="index.php?page=login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php
  }
    ?>
      </ul>
    </div>
  </div>
</nav>
<?php
    }
  }*/
?>