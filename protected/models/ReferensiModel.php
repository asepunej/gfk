<?php
class ReferensiModel extends CFormModel
{

    public function getdaftartahun()
    {  $tahun=Yii::app()->session['tahun_anggaran'];
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_tahun() where tahun='$tahun';")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'tahun','tahun');
        return $lsdata;
    }
    public function getdaftartahunall()
    {  $tahun=Yii::app()->session['tahun_anggaran'];
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_tahun()order by tahun desc;")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'tahun','tahun');
        return $lsdata;
    }

    public function getdaftarskpd()
    {
      $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_skpd();")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_skpd','nama_skpd');
        return $lsdata;
    }
    public function getdaftarskpdunit($id_skpd)
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_skpd_unit('$id_skpd');")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_skpd','nama_skpd');
        return $lsdata;
    }
    public function getdaftargfk()
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_skpd_bylevel(1);")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_skpd','nama_skpd');
        return $lsdata;
    }
    public function getdaftarpuskesmas()
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_skpd_bylevel(2);")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_skpd','nama_skpd');
        return $lsdata;
    }
    public function getdaftarbidang($id_skpd)
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_bidang('$id_skpd');")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_skpd','nama_skpd');
        return $lsdata;
    }
    public function getdaftarbulan()
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_bulan();")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'kdbulan','bulan');
        return $lsdata;
    }

    public function getdaftarjenistransaksi($id_kelompok_transaksi)
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_jenis_transaksi($id_kelompok_transaksi);")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_jenis_transaksi','jenis_transaksi');
        return $lsdata;
    }

    public function getdaftarjenispersediaan()
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_jenis_persediaan();")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_jenis_persediaan','jenis_persediaan');
        return $lsdata;
    }
    public function getdaftarjenisbarang($id_jenis_persediaan)
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_jenis_barang('$id_jenis_persediaan');")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_jenis_barang','jenis_barang');
        return $lsdata;
    }
    public function getdaftarkodejenisbarang($id_jenis_persediaan)
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_jenis_barang('$id_jenis_persediaan')where kd_jenis_barang is not null ;")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'kd_jenis_barang','kd_jenis_barang');
        return $lsdata;
    }
    public function getdaftardistributor()
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_distributor();")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_distributor','distributor');
        return $lsdata;
    }
    public function getdaftarkegiatanbidang($tahun,$id_bidang)
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_kegiatan_bidang($tahun,$id_bidang);")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_kegiatan','kegiatan_lengkap');
        return $lsdata;
    }
    public function getdaftarkegiatanskpd($tahun,$id_skpd)
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_kegiatan_skpd($tahun,$id_skpd);")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_kegiatan','kegiatan_lengkap');
        return $lsdata;
    }

    public function getdaftarsumberdana()
    {
        $dbcmd = Yii::app()->db->createCommand("select * from referensi.fndaftar_sumber_dana();")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_m_sumber_dana','nm_sumber_dana');
        return $lsdata;
    }
    public function getdaftarpenerimaanbybarang($id_barang)
    {
        $id_skpd=Yii::app()->session['id_skpd'];
        $dbcmd = Yii::app()->db->createCommand("select * from master.fndaftar_penerimaan_detail_bybarang($id_barang,$id_skpd);")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_penerimaan_detail','kd_barang');
        return $lsdata;
    }
    public function getdaftarstatusbarang()
    {
        $dbcmd = Yii::app()->db->createCommand("SELECT kd_status_barang, status_barang FROM  referensi.status_barang;")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'kd_status_barang','status_barang');
        return $lsdata;
    }

    public function getdaftarstatus()
    {
        $dbcmd = Yii::app()->db->createCommand("SELECT id_status, status FROM  referensi.status  ;")->queryAll();
        $lsdata = CHtml::listData($dbcmd,'id_status','status');
        return $lsdata;
    }
}
