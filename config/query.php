<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$sql="SELECT SUM(prd_jenissidang.NominalVakasi) AS VakasiSkripsi
        FROM sttitpi_skkp.prd_sidangmaster 
        INNER JOIN sttitpi_skkp.prd_jenissidang ON (prd_sidangmaster.IDJenisSidang = prd_jenissidang.IDJenisSidang)
    INNER JOIN sttitpi_skkp.prd_pendaftaran 
        ON (prd_pendaftaran.IdSidang = prd_sidangmaster.IdSidang)
    INNER JOIN sttitpi_skkp.prd_nilaidetilskirpsi 
        ON (prd_nilaidetilskirpsi.IdPendaftaran = prd_pendaftaran.idPendaftaran)
    INNER JOIN sttitpi_skkp.prd_pengujiskripsi 
        ON (prd_pengujiskripsi.idPendaftaran = prd_pendaftaran.idPendaftaran)
    INNER JOIN sttitpi_skkp.prd_mahasiswa 
        ON (prd_pendaftaran.NIM = prd_mahasiswa.NIM)
        WHERE prd_sidangmaster.IDJenisSidang IN(1,2) AND prd_pengujiskripsi.idUser IN('$ids')
        ORDER BY prd_sidangmaster.Tanggal DESC";