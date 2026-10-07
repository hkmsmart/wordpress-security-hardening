# WP Security Hardening

Hafif, ayar gerektirmeyen WordPress güvenlik eklentisi. Etkinleştir ve kullan, ayar sayfası yok.

## Özellikler

- **Login işlemlerini engelleme**: şifremi unuttum, şifre sıfırlama, kayıt ve ilgili `wp-login.php` işlemlerini kapatır
- **Login linklerini gizleme**: giriş sayfasındaki "Şifrenizi mi unuttunuz?" ve "Kayıt ol" linklerini kaldırır
- **XML-RPC kapatma**: brute force ve DDoS saldırılarında sık kullanılan bir açığı kapatır
- **REST API kısıtlama**: giriş yapmamış kullanıcıların REST isteklerini engeller, sadece Contact Form 7 endpoint'leri açık kalır
- **wp-admin koruma**: giriş yapmamış kullanıcıları ana sayfaya yönlendirir (AJAX çalışmaya devam eder)
- **Brute force koruması**: 5 hatalı giriş denemesinden sonra IP'yi 5 dakika engeller
- **WordPress sürümünü gizleme**: generator meta etiketini kaldırır.

## Kurulum

### Yöntem 1: WordPress paneli üzerinden (ZIP)

1. Bu sayfada **Code → Download ZIP** ile eklentiyi indir.
2. WordPress panelinde **Eklentiler → Yeni Ekle → Eklenti Yükle** sayfasına git.
3. İndirdiğin ZIP dosyasını seç ve **Şimdi Yükle**'ye tıkla.
4. Yükleme bitince **Eklentiyi Etkinleştir**'e tıkla.

### Yöntem 2: FTP / Dosya yöneticisi ile

1. ZIP dosyasını indir ve bilgisayarında aç.
2. `wp-security-hardening` klasörünü sunucunda `wp-content/plugins/` dizinine yükle.
3. WordPress panelinde **Eklentiler** sayfasına git ve **Security Hardening** eklentisini etkinleştir.

### Yöntem 3: Git ile

```bash
cd wp-content/plugins/
git clone https://github.com/hkmsmart/wp-security-hardening.git
```

Ardından panelden eklentiyi etkinleştir.

### Yöntem 4: WP-CLI ile

```bash
cd wp-content/plugins/
git clone https://github.com/hkmsmart/wp-security-hardening.git
wp plugin activate wp-security-hardening
```

### Kurulum sonrası

- Ayar sayfası yoktur. Etkinleştirdiğin anda tüm korumalar devreye girer.
- Kontrol için çıkış yap ve `siteadresin.com/wp-admin` adresine git. Ana sayfaya yönlendirilmen gerekir.
- `siteadresin.com/xmlrpc.php` adresi artık XML-RPC isteklerini kabul etmez.

### Kaldırma

Eklentiyi **Eklentiler** sayfasından devre dışı bırakıp silmen yeterli. Veritabanında kalıcı bir ayar tutulmaz, sadece geçici deneme kayıtları (transient) en fazla 5 dakika içinde kendiliğinden silinir.

## Gereksinimler

- WordPress 5.0+
- PHP 7.4+

## Kurulum

1. `wp-content/plugins/` klasörüne indir veya klonla:
```bash
   git clone https://github.com/hkmsmart/wp-security-hardening.git
```
2. Eklentiler sayfasından **Security Hardening** eklentisini etkinleştir.

## ⚠️ Notlar

- Şifre sıfırlama devre dışıdır. Yöneticiler şifreleri panelden veya WP-CLI ile değiştirmelidir:
  `wp user update <kullanici> --user_pass=<yenisifre>`
- Herkese açık REST API kullanan eklentiler (Contact Form 7 hariç) çalışmaz.

## Lisans

GPLv2 veya üzeri
