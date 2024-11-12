## Uygulamayı Çalıştırmak İçin
\webinars dosyasını C:\xampp\htdocs dosya yoluna gönderin (htdocs klasör yolu değişkenlik gösterebilir.)

# phpMyAdmin Query Ekleme
phpMyAdmin'e yeni Query olarak \webinars\Query.txt doyasının içindeki verileri giriniz ve sorguyu çalıştırınız. 

Ardından aşağıdaki URL'leri takip ederek çıktıları inceleyebilirsiniz.

## Geçerli parametreler ile uyuglamayı çalıştırma
(Status-1)
http://localhost/demo-2/webinars.php?api_key=12345&status=0

(Status-2)
http://localhost/demo-2/webinars.php?api_key=12345&status=1

## Geçersiz parametreler ile uyuglamayı çalıştırma
(Geçersiz API KEY)
http://localhost/webinars.php?api_key=849372

(Geçersiz Status Değeri)
http://localhost/webinars.php?api_key=your-api-key&status=2 
