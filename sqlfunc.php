<?php

/*
 █████╗ ███████╗██╗  ██╗██████╗  █████╗ ███╗   ██╗
██╔══██╗██╔════╝╚██╗██╔╝██╔══██╗██╔══██╗████╗  ██║
███████║█████╗   ╚███╔╝ ██████╔╝███████║██╔██╗ ██║
██╔══██║██╔══╝   ██╔██╗ ██╔═══╝ ██╔══██║██║╚██╗██║
██║  ██║███████╗██╔╝ ██╗██║     ██║  ██║██║ ╚████║
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═╝     ╚═╝  ╚═╝╚═╝  ╚═══╝
*/

function createTable($tableName, $tableColumns) {
    global $db;
    try {
        $sql = "CREATE TABLE IF NOT EXISTS $tableName (";
        foreach($tableColumns as $columnName => $columnType) {
            $sql .= "$columnName $columnType,";
        }
        $sql = rtrim($sql, ","); 
        $sql .= ")";

     
        $db->exec($sql);
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}
function sorgu($sql) {
    global $db;
    $result = $db->query($sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}
function sutunekle($table_name, $column_name, $column_type) {
    global $db;
    try {
        $sql = "ALTER TABLE $table_name ADD $column_name $column_type";
        $query = $db->exec($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}


function tekvericek($tabloadi,$sutunadi,$kosul,$deger)
{
global $db;

$tekverisor=$db->prepare("SELECT*FROM $tabloadi Where $kosul=:value");

$tekverisor->execute(array(
'value' => $deger
));
$tekvericek=$tekverisor->fetch(PDO::FETCH_ASSOC);

$sonuc = $tekvericek["$sutunadi"];
return $sonuc;
}







function verisay($tabloadı,$kosul,$deger){
if ($kosul!="" and $deger!="") {


global $db;

$verisor=$db->prepare("SELECT*FROM $tabloadı where $kosul=:kosul");

$verisor->execute(array(
'kosul'=>$deger
));
return $say=$verisor->rowCount();
}
else {
global $db;

$verisor=$db->prepare("SELECT * FROM $tabloadı");

$verisor->execute(array());

return $say=$verisor->rowCount();
}
}







function veritopla($tabloadi,$deger1,$kosul,$deger){
global $db;
$stok=0;



if ($kosul!=null and $deger!=null) {
$verisor=$db->prepare("SELECT*FROM $tabloadi where $kosul=:kosul");

$verisor->execute(array(
  'kosul'=>$deger
));
}
else {



$verisor=$db->prepare("SELECT*FROM $tabloadi");

$verisor->execute(array());

}
while ($vericek=$verisor->fetch(PDO::FETCH_ASSOC)) {
$stok+=$vericek["$deger1"];

}
return $stok;
}










function vericek($tablo, $sorgu, $sekil) {
  global $db;
  $dbsor = $db->prepare("SELECT * FROM {$tablo} {$sorgu}");
  $dbsor->execute();

  switch ($sekil) {
      case 'TEK':
          if ($dbcek = $dbsor->fetch(PDO::FETCH_ASSOC)) {
              return $dbcek;
          } else {
              return null;
          }
          break;
      case 'ÇOK':
      case 'COK':
          return $dbsor->fetchAll(PDO::FETCH_ASSOC);
          break;
      default:
          if ($dbcek = $dbsor->fetch(PDO::FETCH_ASSOC)) {
              return $dbcek;
          } else {
              return null; 
          }
          break;
  }
}



function veriekle($tabloAdi, $veri) {
  global $db; 

  $sorgu = "INSERT INTO $tabloAdi SET ";
  $params = array();

  foreach ($veri as $sutunAdi => $sutunDegeri) {
    $sorgu .= "$sutunAdi = ?, ";
    array_push($params, $sutunDegeri);
  }

  $sorgu = rtrim($sorgu, ", ");

  $ekle = $db->prepare($sorgu);
  $insert = $ekle->execute($params);

  if ($insert) {
    return true;
  } else {
    return false;
  }
}


function veriupdate($tabloAdi, $veri, $kosul) {
  global $db; 

  $sorgu = "UPDATE $tabloAdi SET ";
  $params = array();

  foreach ($veri as $sutunAdi => $sutunDegeri) {
    $sorgu .= "$sutunAdi = ?, ";
    array_push($params, $sutunDegeri);
  }

  $sorgu = rtrim($sorgu, ", ");
  $sorgu .= " WHERE $kosul";

  $guncelle = $db->prepare($sorgu);
  $update = $guncelle->execute($params);

  if ($update) {
    return true;
  } else {
    return false;
  }
}





function  kaldir($tablo,$id,$id_degisken){
  global $db;
  $query = $db->prepare("DELETE FROM $tablo where $id_degisken='$id'");
  $insert = $query->execute(array());
  if($insert){
    return "1";
  } else {
    return "0";
  }
}



function kaldirall($tablo)
{
  global $db;
  $query = $db->prepare("DELETE FROM $tablo");
  $delete = $query->execute(array());
  if ($delete) {
    return "1";
  } else {
    return "0";
  }
}



?>
