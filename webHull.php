<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } 
class WebHull{
  private $path = '/WebHull/';
  private $rand;
  private $date;
  private $stamp;
  public function __construct(){
    global $wd_root;
    $this->path = $wd_root . $this->path;
    $this->rand = rand(1111, 9999);
    $this->date = date("YmdHis");
    $this->stamp = $this->date . $this->rand;
  }
  public function list_db(){
    $out = array();
    $dir = scandir($this->path); 
    foreach($dir as $key => $value){
      if (!in_array($value,array(".",".."))){
		$out[] = $value;
      }
    }
    return $out;
  }
  public function list_table($db){
    $out = array();
    $dir = scandir($this->path . '/' . $db); 
    foreach($dir as $key => $value){
      if (!in_array($value,array(".",".."))){
		$out[] = pathinfo($value,PATHINFO_FILENAME);
      }
    }
    return $out;
  }
  public function create_db($db){

    if(!file_exists($this->path)){
		mkdir($this->path);
    }
    if(!file_exists($this->path . $db)){
  		if(!mkdir($this->path . $db))
          return $stat = "Error: Could not create database file. Do you have permissions?";
     	else
    		return $stat = "Success";
    }
    else{
        return $stat = "Error: File already exists.";
      }
      
  }
  public function create_table($db, $table, $row){
    if(!file_exists($this->path)){
		mkdir($this->path);
    }
    if(!file_exists($this->path . $db)){
  	mkdir($this->path . $db);
    //return $stat = "Success";
    }
      if(!file_exists($this->path . $db . "/" . $table . ".json")){
      //$arr = array($row);
      $data = array('row1' => explode(',', $row));
      $json = json_encode($data);
      file_put_contents($this->path . $db . "/" . $table . ".json", $json);
      return $stat = "Success";
      }
      else{
        return $stat = "Error: File already exists.";
      }
  }
  public function drop_db($db){
    if(file_exists($this->path . $db)){
  	$dir = scandir($this->path . $db); 
    foreach($dir as $key => $value){
      if (!in_array($value,array(".",".."))){
        unlink($this->path . $db . "/" . $value);
      }
    }
    rmdir($this->path . $db);
      return $stat = "Success";
    }
    else{
      return $stat = "Error: Database doesn't exists.";
    }
  }
  public function drop_table($db, $table){
    if(file_exists($this->path . $db . "/" . $table . ".json")){
      unlink($this->path . $db . "/" . $table . ".json");
      return $stat = "Success";
    }
    else{
      return $stat = "Error: Table does not exist." . $this->path . $db . "/" . $table . ".json";
    }
  }
  public function backup_db($db, $newdb){
    if(file_exists($this->path . $db)){
  	function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 
    recurse_copy($this->path . $db, $this->path . $newdb);
      return $stat = "Success";
  }
    else{
      return $stat = "Error: Database does not exists.";
    }
  }
  public function insert_data($db, $table, $id){
    if(file_exists($this->path . $db . "/" . $table . ".json")){
        $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
        $data['row' . $this->stamp] = explode(',', $id);
        $json = json_encode($data);
        file_put_contents($this->path . $db . "/" . $table . ".json", $json);
        return $stat = "Success";
  }
    else{
      return $stat = "Error: Table does not exists.";
    }
  }
  public function delete_data($db, $table, $key){
      if(file_exists($this->path . $db . "/" . $table . ".json")){
        $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
        unset($data[$key]);
        $json = json_encode($data);
        file_put_contents($this->path . $db . "/" . $table . ".json", $json);
        return $stat = "Success";
      }
    else{
      return $stat = "Error: Table does not exists.";
    }
  }
  public function update_id($db, $table, $id, $row){
      if(file_exists($this->path . $db . "/" . $table . ".json")){
        $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
        $data[$id] = explode(',', $row); 
        $json = json_encode($data);
        file_put_contents($this->path . $db . "/" . $table . ".json", $json);
        return $stat = "Success";
      }
    else{
      return $stat = "Error: Table does not exists.";
    }
  }
  public function update_data($db, $table, $id, $row, $con){
      if(file_exists($this->path . $db . "/" . $table . ".json")){
        $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
        $x = 0;
        $y = "error";
        foreach($data['row1'] as $value){
          if($value == $row){
            $y = $x;
          }
          $x = $x + 1;
        }
        if($y != "error"){
          $data['row' . $id][$y] = $con;
          $json = json_encode($data);
          file_put_contents($this->path . $db . "/" . $table . ".json", $json);
          return $stat = "Success";
        }
      }
    else{
      return $stat = "Error: Table does not exists.";
    }
  }
  public function select_row($db, $table, $row){
      if(file_exists($this->path . $db . "/" . $table . ".json")){
        $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
        $x = 0;
        $y = "error";
        foreach($data['row1'] as $value){
          if($value == $row){
            $y = $x;
          }
          $x = $x + 1;
        }
        if($y !== "error"){
          $out = array();
          foreach($data as $key => $value){
            //array_push($out, $data[$key][$y]);
            $out[$key] = $data[$key][$y];
          }
          return $out;
        }
      }
  }
  public function select_id($db, $table, $key){
      if(file_exists($this->path . $db . "/" . $table . ".json")){
        $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
        return $out = $data[$key];
      }
    else{
      return $stat = "Error: Table does not exists.";
    }
  }
  public function select_table($db, $table, $col){
      if(file_exists($this->path . $db . "/" . $table . ".json")){
        $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
        $count = count($data['row1']);
        if($col > $count){
          $col = 0;
        }
        if($col != 0){
          $col = $col - 1;
        $out = array();
        $temp['row1'] = $data['row1'];
        foreach($data as $key => $value){
            if($key != 'row1'){
              $temp[$key] = $data[$key][$col];
            }
          }
        asort($temp);
        foreach($temp as $key => $value){
          $out[$key] = $data[$key]; 
        }
        }
        else{
          $out = $data;
        }
        return $out;
      }
    else{
      return $stat = "Error: Table does not exists.";
    }
  }
  public function search_row($db, $table, $row, $search){
      if(file_exists($this->path . $db . "/" . $table . ".json")){
        $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
        $y = "error";
        foreach($data['row1'] as $key => $value){
          if(trim($value) == trim($row)){
            $y = $key;
          }
        }
        if($y != "error"){
          $out['row1'] = $data['row1'];
          foreach($data as $key => $value){
            if(trim($data[$key][$y]) == trim($search)){
              $out[$key] = $data[$key];
            }
          }
          return $out;
        }
      }
    else{
      return $stat = "Error: Table does not exists.";
    }
  }
  public function add_col($db, $table, $col){
    if(file_exists($this->path . $db . "/" . $table . ".json")){
        $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
      array_push($data['row1'], trim($col));
      foreach($data as $key => $value){
        if($key != 'row1'){
          array_push($data[$key], '');
        }
      }
      $json = json_encode($data);
          file_put_contents($this->path . $db . "/" . $table . ".json", $json);
          return $stat = "Success";
    }
    else{
      return $stat = "Error: Table does not exists.";
    }
  }
  public function rm_col($db, $table, $col){
    if(file_exists($this->path . $db . "/" . $table . ".json")){
        $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
      foreach($data as $key => $value){
        unset($data[$key][$col]);
      }
      $json = json_encode($data);
          file_put_contents($this->path . $db . "/" . $table . ".json", $json);
          return $stat = "Success";
    }
    else{
      return $stat = "Error: Table does not exists.";
    }
  }
  public function export_csv($db, $table, $filename){
    function array2csv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}
    function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}
    if(file_exists($this->path . $db . "/" . $table . ".json")){
      $data = json_decode(file_get_contents($this->path . $db . "/" . $table . ".json"), true);
      download_send_headers($filename);
		echo array2csv($data);
		die();
    }
    else{
      return $stat = "Error: Table does not exists.";
    }
  }
  public function import_csv($db, $table, $filename){
   $row = 1;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
} 
  }
}
$wd_webHull = new WebHull();
?>                                                                                                                                                                                                                                                
