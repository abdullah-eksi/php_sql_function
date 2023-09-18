# PHP ile SQL Fonksiyonları Kullanımı

Bu Fonksiyonlar, PHP ile MySQL veritabanı ile çalışmak için bazı yardımcı SQL fonksiyonlarını içerir. Bu fonksiyonlar, veritabanına veri eklemek, güncellemek, silmek ve veri almak gibi temel işlemleri kolaylaştırmak için tasarlanmıştır. fonksiyonları global olarak veritabanına baglıyoruz veritabanı baglantınızı global olarak cağırıp gerekli değişikli yapıp kodları kullanıp veritabanı işlemlerini hızlandırabilirsiniz

## Fonksiyonlar ve Kullanımı

### 1. `veriekle($tabloAdi, $veri)`

Bu fonksiyon, belirtilen tabloya veri eklemek için kullanılır.

Örnek Kullanım:
  ```php
$params =  [ 
  "ad" => "John", 
  "soyad" => "Doe", 
  "email" => "john@example.com"
];

$process = veriekle("kullanicilar", $params);

if ($process) {
  echo "Veri başarıyla eklendi.";
} else {
  echo "Veri eklenirken bir hata oluştu.";
}
 ```

### 2.`veriupdate($tabloAdi, $veri, $kosul)`

Bu fonksiyon, belirtilen tablodaki veriyi güncellemek için kullanılır.

Örnek Kullanım:


```php
$params = 
[
  "email" => "john.doe@example.com"
];

$process = veriupdate("kullanicilar", $params, "id = 1");

if ($process) {
  echo "Veri başarıyla güncellendi.";
} else {
  echo "Veri güncellenirken bir hata oluştu.";
}
 ```


### 3. `kaldir($tablo, $id, $id_degisken)`

Bu fonksiyon, belirtilen tablodan bir veri satırını kaldırmak için kullanılır.

Örnek Kullanım:
  ```php
$id = 1; 
$id_degisken = "id";
$process = kaldir("kullanicilar", $id, $id_degisken);

if ($process) {
  echo "Veri başarıyla kaldırıldı.";
} else {
  echo "Veri kaldırılırken bir hata oluştu.";
}
 ```

### 4. `kaldirall($tablo)`

Bu fonksiyon, belirtilen tablodaki tüm verileri kaldırmak için kullanılır.

Örnek Kullanım:
```php
$process = kaldirall("kullanicilar");

if ($process) {
  echo "Tüm veriler başarıyla kaldırıldı.";
} else {
  echo "Veriler kaldırılırken bir hata oluştu.";
}
```

### 5. `createTable($tableName, $tableColumns)`

   Bu fonksiyon, veritabanında yeni bir tablo oluşturur veya mevcut bir tabloyu günceller.

   Örnek Kullanım:
   
  ```php

   $tableName = "kullanicilar"; 
   $tableColumns = [ 
       "id" => "INT PRIMARY KEY", 
       "username" => "VARCHAR(255)", 
       "email" => "VARCHAR(255)" 
   ];  
   $process = createTable($tableName, $tableColumns);

   if ($process) {
       echo "Tablo başarıyla oluşturuldu veya güncellendi.";
   } else {
       echo "Tablo oluşturulurken bir hata oluştu.";
   }
  ```

### 6. `sorgu($sql)`

  ```php
   Bu fonksiyon, özel bir SQL sorgusunu veritabanında çalıştırır.

   Örnek Kullanım:


   $sql = "SELECT * FROM kullanicilar WHERE username='john'";
   $process = sorgu($sql);

   if ($process) {
       // Sorgu başarılı
   } else {
       // Sorgu başarısız
   }
  ```

### 7. `sutunekle($table_name, $column_name, $column_type)`

   Bu fonksiyon, mevcut bir tabloya yeni bir sütun ekler.

   Örnek Kullanım:
   
  ```php
   $table_name = "kullanicilar";
   $column_name = "birthdate";
   $column_type = "DATE";
   $process = sutunekle($table_name, $column_name, $column_type);

   if ($process) {
       echo "Yeni sütun başarıyla eklendi.";
   } else {
       echo "Sütun eklenirken bir hata oluştu.";
   }
  ```


### 8. `tekvericek($tabloadi, $sutunadi, $kosul, $deger)`

   Bu fonksiyon, belirtilen tablodan belirli bir koşula göre tek bir veri çeker.

   Örnek Kullanım:

   ```php
   $tabloadi = "kullanicilar";
   $sutunadi = "username";
   $kosul = "id";
   $deger = 1;
   $username = tekvericek($tabloadi, $sutunadi, $kosul, $deger);
 ```

### 6. `verisay($tabloadı, $kosul, $deger)`

   Bu fonksiyon, belirtilen tabloda belirli bir koşula göre veri sayısını döndürür.

   Örnek Kullanım:

   ```php
   $tabloadı = "kullanicilar";
   $kosul = "status";
   $deger = "active";
   $count = verisay($tabloadı, $kosul, $deger);
   ```

### 7. `veritopla($tabloadi, $deger1, $kosul, $deger)`

   Bu fonksiyon, belirtilen tablodan belirli bir sütunu toplar ve sonucu döndürür.

   Örnek Kullanım:

 ```php
   $tabloadi = "urunler";
   $deger1 = "stok";
   $kosul = "kategori";
   $deger = "elektronik";
   $totalStock = veritopla($tabloadi, $deger1, $kosul, $deger);
   
   ```
### 8. `vericek($tablo, $sorgu, $sekil)`

   Bu fonksiyon, belirtilen tablodan verileri çeker ve sonucu istenen şekilde döndürür.

   Örnek Kullanım 1:

   ```php
   $tablo = "mesajlar";
   $sorgu = "WHERE status = 1";
   $sekil = "ÇOK";
   $messages = vericek($tablo, $sorgu, $sekil);
  foreach ($messages as $message) {
  echo $message["message_id"]; 
  }

   ```

   Örnek Kullanım 2:

   ```php
   $tablo = "mesajlar";
   $sorgu = "WHERE kullanici_id = 1";
   $sekil = "TEK";
   $message = vericek($tablo, $sorgu, $sekil);
    echo $message["message_id"];

   ```

 Bu fonksiyonlar, MySQL veritabanıyla çalışmak için tasarlanmıştır. Başka bir veritabanı türü kullanıyorsanız, bağlantı ayarlarınızı güncellemeniz gerekebilir.

