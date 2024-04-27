# TP3DPBO2024C1
## Desain Program

Program ini dirancang dengan menggunakan PHP untuk membuat GUI.  Kelas-kelas dalam proyek ini adalah sebagai berikut:

1. `DB`: Kelas ini bertindak sebagai kelas dasar untuk interaksi dengan database. Metode dalam kelas ini termasuk `open()`, `close()`, `execute()`, dan `executeAffected()`. Metode ini digunakan untuk membuka dan menutup koneksi database, menjalankan query, dan mendapatkan hasil.

2. `Movies`: Kelas ini mewarisi dari kelas `DB` dan digunakan untuk mengelola film (movies) dalam aplikasi. Metode dalam kelas ini termasuk `getMovies()`, `sortMovies()`, dan `searchMovies()`. Metode ini digunakan untuk mendapatkan daftar film, mengurutkan film, dan mencari film.

3. `Series`: Kelas ini mewarisi dari kelas `DB` dan digunakan untuk mengelola serial TV (series) dalam aplikasi. Metode dalam kelas ini termasuk `getSeries()`, `sortSeries()`, dan `searchSeries()`. Metode ini digunakan untuk mendapatkan daftar serial TV, mengurutkan serial TV, dan mencari serial TV.

4. `Template`: Kelas ini digunakan untuk mengelola template HTML dalam aplikasi. Metode dalam kelas ini termasuk `replace()` dan `write()`. Metode ini digunakan untuk mengganti placeholder dalam template dengan data dan menulis output ke browser.

5. `Country`: Kelas ini mewarisi dari kelas `DB` dan digunakan untuk mengelola negara dalam aplikasi. Metode dalam kelas ini termasuk `getCountry()`, `getCountryById()`, `addCountry()`, `updateCountry()`, dan `deleteCountry()`. Metode ini digunakan untuk mendapatkan daftar negara, mendapatkan negara berdasarkan id, menambahkan negara, memperbarui negara, dan menghapus negara.

6. `Genre`: Kelas ini mewarisi dari kelas `DB` dan digunakan untuk mengelola genre dalam aplikasi. Metode dalam kelas ini termasuk `getGenre()`, `getGenreById()`, `addGenre()`, `updateGenre()`, dan `deleteGenre()`. Metode ini digunakan untuk mendapatkan daftar genre, mendapatkan genre berdasarkan id, menambahkan genre, memperbarui genre, dan menghapus genre.


## Alur Program
Pengguna memungkinkan untuk:

- Melihat daftar film dan serial TV: Halaman utama aplikasi menampilkan daftar film dan serial TV. Pengguna dapat melihat detail lebih lanjut dengan mengklik tautan "See Detail" pada setiap film atau serial TV.

- Mengurutkan daftar film dan serial TV berdasarkan tahun rilis: aplikasi akan mengurutkan daftar film dan serial TV berdasarkan arah yang ditentukan (ascending/descending).

- Mencari film dan serial TV berdasarkan title: aplikasi akan mencari film dan serial TV berdasarkan kata kunci yang diberikan.

- Melakukan CRUD data movies, series, genre dan negara.

Semua halaman ini menggunakan template HTML yang didefinisikan dalam kelas `Template`, dan semua interaksi dengan database dikelola oleh kelas `DB`, `Movies`, `Series`, dan `Country`.

## Dokumentasi


https://github.com/boyaditya/TP3DPBO2024C1/assets/135103722/aaf49f46-3c4c-4859-a302-c56e39046e54



### Halaman Utama
![screencapture-localhost-8080-application-dpbo-videos-index-php-2024-04-26-13_50_58](https://github.com/boyaditya/TP3DPBO2024C1/assets/135103722/f054e89d-6cd5-4656-9e85-bd795387abec)

### See Detail
![image](https://github.com/boyaditya/TP3DPBO2024C1/assets/135103722/838fd55c-7dab-4b3e-a220-8baa929d7412)

### Create Data
![screencapture-localhost-8080-application-dpbo-videos-add-movie-php-2024-04-26-14_18_12](https://github.com/boyaditya/TP3DPBO2024C1/assets/135103722/1b6c1f22-96c4-4cbd-bd7b-a4ee30175f6e)

### Data Table
![screencapture-localhost-8080-application-dpbo-videos-genre-php-2024-04-26-14_19_06](https://github.com/boyaditya/TP3DPBO2024C1/assets/135103722/8511df27-12ba-4399-8ae5-0fedb2c4387d)



