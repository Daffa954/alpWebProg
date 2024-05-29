CREATE TABLE `user` (
    `id_user` INT NULL AUTO_INCREMENT,
    `nama` VARCHAR(250) NOT NULL,
    `email` VARCHAR(250) NOT NULL,
    `password` VARCHAR(10) NOT NULL,
    `no_telp` VARCHAR(20),
    `saldo` INT,
    `photo` VARCHAR(250),
    `role` INT NOT NULL,
    PRIMARY KEY (`id_user`)
) ENGINE = InnoDB;

CREATE TABLE `produk` (
    `id_produk` INT NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(250) NOT NULL,
    `deskripsi` TEXT NOT NULL,
    `kategori` VARCHAR(250) NOT NULL,
    `jumlah` INT NOT NULL,
    `harga` INT NOT NULL,
    PRIMARY KEY (`id_produk`)
) ENGINE = InnoDB;

CREATE TABLE `memesan`(
    `id_memesan` INT AUTO_INCREMENT PRIMARY KEY,
    `id_user` INT,
    `id_produk` INT,
    `no_pesanan` INT,
    `jumlah` INT,
    `harga` INT,
    FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
    FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
); 