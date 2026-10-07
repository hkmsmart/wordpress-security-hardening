# WP Security Hardening

Hafif, ayar gerektirmeyen WordPress güvenlik eklentisi. Etkinleştir ve kullan, ayar sayfası yok.

## Özellikler

- **Login işlemlerini engelleme**: şifremi unuttum, şifre sıfırlama, kayıt ve ilgili `wp-login.php` işlemlerini kapatır
- **Login linklerini gizleme**: giriş sayfasındaki "Şifrenizi mi unuttunuz?" ve "Kayıt ol" linklerini kaldırır
- **XML-RPC kapatma**: brute force ve DDoS saldırılarında sık kullanılan bir açığı kapatır
- **REST API kısıtlama**: giriş yapmamış kullanıcıların REST isteklerini engeller, sadece Contact Form 7 endpoint'leri açık kalır
- **wp-admin koruma**: giriş yapmamış kullanıcıları ana sayfaya yönlendirir (AJAX çalışmaya devam eder)
- **Brute force koruması**: 5 hatalı giriş denemesinden sonra IP'yi 5 dakika engeller
- **WordPress sürümünü gizleme**: generator meta etiketini kaldırır

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
