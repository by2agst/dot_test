## SPRINT 2

How to use:
- download / clone proyek ini
- lakukan `commposer install`
- copy `.env.example` and rename `.env`
- edit isi `.env` sesuai kebutuhan
- `php artisan:migrate` untuk migrasi database `provinces` dan `cities`
- `php artisan jwt:secret`
- `php artisan getro:provinces` command untuk mendapatkan provisi dari raja ongkir
- `php artisan getro:cities` command untuk mendapatkan kota dari raja ongkir
- `php artisan serve`
- gunakan header `Authorization : Bearer <JWT>` untuk melakukan request
- url provinsi : http://127.0.0.1:8000/search/provinces?id={id}
- url kota : http://127.0.0.1:8000/search/cities?id={id}
- ubah `.env` `DATA_FROM=rajaongkir` swap pengambilan data dari database (null) / rajaongkir